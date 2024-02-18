<?php

namespace Aldeebhasan\MigrationMapper;

use Aldeebhasan\MigrationMapper\Enums\ColumnTypeEnum;
use Aldeebhasan\MigrationMapper\Enums\MethodTypeEnum;
use Aldeebhasan\MigrationMapper\Logic\Blueprint\ColumnPb;
use Aldeebhasan\MigrationMapper\Logic\Blueprint\TablePb;
use Aldeebhasan\MigrationMapper\Logic\Migration\MigrationManager;
use Aldeebhasan\MigrationMapper\Logic\Models\ConfigHandler;
use Aldeebhasan\MigrationMapper\Logic\Models\ModelHandler;
use Aldeebhasan\MigrationMapper\Logic\Models\RelationHandler;
use Aldeebhasan\MigrationMapper\Traits\Makable;
use Illuminate\Support\Facades\File;

class MigrationMapperManager
{
    use  Makable;

    private MigrationManager $migrationManager;

    private array $tableLog = [];

    public function __construct()
    {
        $this->migrationManager = MigrationManager::make();
    }

    public function generateMigration(): array
    {
        $this->tableLog = [];
        $paths = config('migration-mapper.model_paths');

        foreach ($paths as $path) {
            $this->handlePath($path);
        }
        if (! empty($this->tableLog)) {
            $this->migrationManager->generateTrackLog(array_column($this->tableLog, 'table'));
        }

        return  $this->tableLog;
    }

    public function regenerateMigration(): array
    {
        $this->tableLog = [];
        $this->clearDir(database_path('migrations'), '_m');
        $this->clearDir(storage_path('migration-mapper'));
        $this->clearDir(storage_path('logs'));

        $this->generateMigration();

        return  $this->tableLog;
    }

    public function rollbackMigration(): void
    {
        $this->migrationManager->clearLastTrackLog();
    }

    private function clearDir(string $path, string $suffix = ''): void
    {
        if (File::exists($path)) {
            foreach (File::files($path) as $file) {
                if (! $suffix || str_ends_with($file->getFilenameWithoutExtension(), $suffix)) {
                    File::delete($file->getPathname());
                }

            }
        }
    }

    private function handlePath(string $path): void
    {
        $files = scandir($path);
        foreach ($files as $file) {
            if ($file === '.' || $file === '..') {
                continue;
            }
            $filePath = implode('/', [$path, $file]);
            if (is_dir($filePath)) {
                $this->handlePath($filePath);
            } elseif (is_file($filePath)) {
                $this->handleModels($filePath);
            }
        }
    }

    private function handleModels(string $path): void
    {
        $model = ModelHandler::make($path)->handle();

        $tableName = $model->getTableName();
        $configs = $model->getConfig();

        $this->handleModelConfig($tableName, $configs);

        if (! empty($configs['tables'])) {
            foreach ($configs['tables'] as $extraTableName => $extraTableConfigs) {
                $this->handleModelConfig($extraTableName, $extraTableConfigs);
            }
        }
    }

    private function handleModelConfig(string $tableName, array $configs): void
    {
        $lastConfig = $this->migrationManager->retrieveLastLog($tableName);
        $baseTable = $this->convertToBlueprint(tableName: $tableName, newConfig: $configs, lastConfig: $lastConfig);
        $lastTable = $this->convertToBlueprint(tableName: $tableName, newConfig: $lastConfig ?? []);

        if (! $baseTable->isEmpty()) {
            //export the migration file
            $migrationPath = $this->migrationManager->generateStub($baseTable, $lastTable);
            $this->migrationManager->generateLog($tableName, $configs);
            $this->tableLog[] = ['table' => $tableName, 'file' => $migrationPath];
        }
    }

    private function convertToBlueprint(string $tableName, array $newConfig, ?array $lastConfig = null): TablePb
    {
        $method = 'create';
        $newColumns = $newConfig['columns'] ?? [];
        $newRelations = $newConfig['relations'] ?? [];

        if ($lastConfig) {
            $newColumns = ConfigHandler::make()->setConfig($newConfig['columns'])->diff($lastConfig['columns']);
            $newRelations = RelationHandler::make()->setConfig($newConfig['relations'])->diff($lastConfig['relations']);
            $method = 'update';
        }

        $baseTable = $this->migrationManager->makeTable($tableName, $method);
        //handle columns
        $this->handleColumnsInBlueprint($baseTable, $newColumns);
        //handle relations
        $this->handleRelationsInBlueprint($baseTable, $newRelations);

        return $baseTable;
    }

    private function handleColumnsInBlueprint(TablePb $baseTable, $columnsConfig): void
    {
        foreach ($columnsConfig as $colName => $columnConfig) {
            $type = $columnConfig['type'];
            $properties = $columnConfig['properties'];
            $oldProperties = $columnConfig['old_properties'] ?? null;

            if ($columnConfig['status'] !== 'delete') {
                $baseColumn = $this->migrationManager->makeColumn($type, $colName, ...$properties);
                foreach ($columnConfig['configurations'] ?? [] as $config) {
                    $this->handleSingleColumnConfig($baseTable, $baseColumn, $config);
                }
                $hasChanged = $baseColumn->isNotEmpty() || ($oldProperties && $properties != $oldProperties);
                if ($columnConfig['status'] === 'update' && $hasChanged) {
                    $baseMethod = $this->migrationManager->makeMethod(MethodTypeEnum::CHANGE->value);
                    $baseColumn->chain($baseMethod);
                }
                if ($baseColumn->isNotEmpty() || $columnConfig['status'] === 'create') {
                    $baseTable->chain($baseColumn);
                }
            } else {
                $baseColumn = $this->migrationManager->makeColumn(ColumnTypeEnum::DROP_COLUMN->value, $colName);
                $baseTable->chain($baseColumn);
            }
        }
    }

    private function handleSingleColumnConfig(TablePb $baseTable, ColumnPb $baseColumn, array $config): void
    {
        if ($config['status'] === 'create') {
            $propertyData = explode(':', $config['type']);
            $baseMethod = $this->migrationManager->makeMethod($propertyData[0], $propertyData[1] ?? null);
            $baseColumn->chain($baseMethod);
        } else {
            $method = $config['type'];
            if (in_array($method, ['index', 'fulltext', 'unique'])) {
                $method = 'drop'.str($method)->title();
                $column = $this->migrationManager->makeColumn($method, $baseColumn->getName());
                $baseTable->chain($column);
            }
        }

    }

    private function handleRelationsInBlueprint(TablePb $baseTable, $relationsConfig): void
    {
        foreach ($relationsConfig as $key => $relationConfig) {
            if ($relationConfig['status'] !== 'delete') { //update or create
                $baseColumn = $this->migrationManager->makeColumn($relationConfig['type'], $key);
                $baseColumn->chain(
                    $this->migrationManager->makeMethod(MethodTypeEnum::REFERENCES->value, $relationConfig['reference'])
                );
                $baseColumn->chain(
                    $this->migrationManager->makeMethod(MethodTypeEnum::ON->value, $relationConfig['table'])
                );
            } else {
                $baseColumn = $this->migrationManager->makeColumn(ColumnTypeEnum::DROP_FOREIGN->value, $key);
            }
            $baseTable->chain($baseColumn);
        }
    }
}
