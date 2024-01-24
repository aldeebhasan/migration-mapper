<?php

namespace Aldeebhasan\Emigrate;

use Aldeebhasan\Emigrate\Logic\Blueprint\TablePb;
use Aldeebhasan\Emigrate\Logic\Migration\MigrationManager;
use Aldeebhasan\Emigrate\Logic\Models\ModelHandler;
use Aldeebhasan\Emigrate\Traits\Makable;
use Illuminate\Support\Facades\File;

class EmigrateManager
{
    use  Makable;

    private MigrationManager $migrationManager;

    public function __construct()
    {
        $this->migrationManager = MigrationManager::make();
    }

    public function generateMigration(): void
    {
        $paths = config('emigrate.model_paths');

        foreach ($paths as $path) {
            $this->handlePath($path);
        }

    }

    public function regenerateMigration(): void
    {
        $this->clearDir(database_path('migrations'));
        $this->clearDir(storage_path('emigrate'));

        $this->generateMigration();
    }

    private function clearDir(string $path): void
    {
        if (File::exists($path)) {
            foreach (File::files($path) as $file) {
                File::delete($file->getPathname());
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
        $columnsConfig = $model->getConfig();

        $baseTable = $this->convertToBlueprint($tableName, $columnsConfig);

        //export the migration file
        $this->migrationManager->generateStub($baseTable);
        $this->migrationManager->generateLog($tableName, $columnsConfig);
    }

    private function convertToBlueprint(string $tableName, array $columns): TablePb
    {
        $lastMigration = $this->migrationManager->retrieveLastLog($tableName);
        $toUpdate = ! empty($lastMigration);

        $baseTable = $this->migrationManager->makeTable($tableName, $toUpdate ? 'update' : 'create');
        foreach ($columns as $name => $columnConfig) {
            $type = $columnConfig['type'];
            $properties = $columnConfig['properties'];
            $baseColumn = $this->migrationManager->makeColumn($type, $name, ...$properties);
            foreach ($columnConfig['configurations'] ?? [] as $config) {
                $propertyData = explode(':', $config);
                $baseMethod = $this->migrationManager->makeMethod($propertyData[0], $propertyData[1] ?? '');
                $baseColumn->chain($baseMethod);
            }
            if ($toUpdate) {
                $baseMethod = $this->migrationManager->makeMethod('change');
                $baseColumn->chain($baseMethod);
            }
            $baseTable->chain($baseColumn);
        }

        return $baseTable;
    }
}
