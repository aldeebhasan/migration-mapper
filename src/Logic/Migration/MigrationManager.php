<?php

namespace Aldeebhasan\Emigrate\Logic\Migration;

use Aldeebhasan\Emigrate\Logic\Blueprint\ColumnPb;
use Aldeebhasan\Emigrate\Logic\Blueprint\MethodPb;
use Aldeebhasan\Emigrate\Logic\Blueprint\TablePb;
use Aldeebhasan\Emigrate\Logic\IO\FileIO;
use Aldeebhasan\Emigrate\Logic\IO\StubIO;
use Aldeebhasan\Emigrate\Logic\IO\TrackO;
use Aldeebhasan\Emigrate\Traits\Makable;

class MigrationManager
{
    use Makable;

    private ColumnFactory $columnManager;

    private MethodFactory $methodManager;

    private FileIO $stubManager;

    private FileIO $logManager;

    public function __construct()
    {
        $this->columnManager = ColumnFactory::make();
        $this->methodManager = MethodFactory::make();
        $this->stubManager = StubIO::make();
        $this->logManager = TrackO::make();
    }

    public function makeTable(string $name, string $action = 'create'): TablePb
    {
        return (new TablePb())
            ->setName($name)
            ->setAction($action);
    }

    public function makeColumn(string $method, string $name = '', ...$args): ColumnPb
    {
        $targetColumn = $this->columnManager->{$method}($name, ...$args);

        return ColumnPb::make()->setColumn($targetColumn);
    }

    public function makeMethod(string $method, string $value = '', ...$args): MethodPb
    {
        $targetMethod = $this->methodManager->{$method}($value, ...$args);

        return MethodPb::make()->setMethod($targetMethod);
    }

    public function generateStub(TablePb $tablePb, ?TablePb $lastTablePb): void
    {
        $this->stubManager->read(stub_path('migration.generate.anonymous.stub'));
        $this->stubManager->prepare($tablePb->toString(), $tablePb->toStringReversed($lastTablePb));
        $prefix = now()->format('Y_m_d_').time();
        $method = $tablePb->isUpdate() ? 'update' : 'create';
        $tableName = $tablePb->getName();
        $path = database_path("migrations/{$prefix}_{$method}_{$tableName}_table.php");
        $this->stubManager->write($path);
    }

    public function generateLog(string $table, array $config): void
    {
        $path = storage_path("emigrate/migrations_{$table}.json");
        $this->logManager->read($path);
        $this->logManager->prepare(json_encode($config));
        $this->logManager->write($path);
    }

    public function retrieveLastLog(string $table): ?array
    {
        $path = storage_path("emigrate/migrations_{$table}.json");
        $this->logManager->read($path);

        return $this->logManager->lastLog($table);
    }
}
