<?php

namespace Aldeebhasan\MigrationMapper\Logic\Migration;

use Aldeebhasan\MigrationMapper\Logic\Blueprint\ColumnPb;
use Aldeebhasan\MigrationMapper\Logic\Blueprint\MethodPb;
use Aldeebhasan\MigrationMapper\Logic\Blueprint\SchemaPb;
use Aldeebhasan\MigrationMapper\Logic\Blueprint\TablePb;
use Aldeebhasan\MigrationMapper\Logic\IO\FileIO;
use Aldeebhasan\MigrationMapper\Logic\IO\StubIO;
use Aldeebhasan\MigrationMapper\Logic\IO\TrackO;
use Aldeebhasan\MigrationMapper\Traits\Makable;

class MigrationManager
{
    use Makable;

    private ColumnFactory $columnManager;

    private MethodFactory $methodManager;

    private FileIO $stubManager;

    private FileIO $trackManager;

    private FileIO $logManager;

    private int $stubCounter = 0;

    public function __construct()
    {
        $this->columnManager = ColumnFactory::make();
        $this->methodManager = MethodFactory::make();
        $this->stubManager = StubIO::make();
        $this->trackManager = TrackO::make();
        $this->logManager = TrackO::make();
    }

    public function makeTable(string $name, string $action = 'create'): TablePb
    {
        return (new TablePb())
            ->setName($name)
            ->setAction($action);
    }

    public function makeSchema(): SchemaPb
    {
        return new SchemaPb();
    }

    public function makeColumn(string $method, string $name = '', ...$args): ColumnPb
    {
        $targetColumn = $this->columnManager->{$method}($name, ...$args);

        return ColumnPb::make()->setColumn($targetColumn);
    }

    public function makeMethod(string $method, ?string $value = null, ...$args): MethodPb
    {
        $targetMethod = $this->methodManager->{$method}($value, ...$args);

        return MethodPb::make()->setMethod($targetMethod);
    }

    public function generateStub(TablePb $tablePb, ?TablePb $lastTablePb): void
    {
        $this->stubManager->read(stub_path('migration.generate.anonymous.stub'));
        $this->stubManager->prepare($tablePb->toString(), '' /*$tablePb->toStringReversed($lastTablePb)*/);
        //add some seconds to keep the ordering of the generated migration files
        $prefix = now()->format('Y_m_d_').(time() + $this->stubCounter++);
        $method = $tablePb->isUpdate() ? 'update' : 'create';
        $tableName = $tablePb->getName();
        $path = database_path("migrations/{$prefix}_{$method}_{$tableName}_table_m.php");
        $this->stubManager->write($path);
    }

    public function generateLog(string $table, array $config): void
    {
        $path = storage_path("migration-mapper/migrations_{$table}.json");
        $this->trackManager->read($path);
        $this->trackManager->prepare(json_encode($config));
        $this->trackManager->write($path);
    }

    public function retrieveLastLog(string $table): ?array
    {
        $path = storage_path("migration-mapper/migrations_{$table}.json");
        $this->trackManager->read($path);

        return $this->trackManager->lastLog();
    }

    public function clearLastLog(string $table): bool
    {
        $path = storage_path("migration-mapper/migrations_{$table}.json");
        $this->trackManager->read($path);
        if ($this->trackManager->excludeLastLog()) {
            $this->trackManager->write($path);

            return true;
        }

        return false;
    }

    public function generateTrackLog(array $tables): void
    {
        $path = storage_path('migration-mapper/logs.json');
        $this->trackManager->read($path);
        $this->trackManager->prepare(json_encode(['time' => now()->toDateTimeString(), 'tables' => $tables]));
        $this->trackManager->write($path);
    }

    public function clearLastTrackLog(): bool
    {
        $path = storage_path('migration-mapper/logs.json');
        $this->trackManager->read($path);
        $log = $this->trackManager->lastLog();
        if ($this->trackManager->excludeLastLog()) {
            $this->trackManager->write($path);

            foreach ($log['tables'] ?? [] as $table) {
                $this->clearLastLog($table);
            }

            return true;
        }

        return false;
    }
}
