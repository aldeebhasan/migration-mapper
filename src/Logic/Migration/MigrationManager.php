<?php

namespace Aldeebhasan\Emigrate\Logic\Migration;

use Aldeebhasan\Emigrate\Logic\Blueprint\BlueprintIU;
use Aldeebhasan\Emigrate\Logic\Blueprint\ColumnPb;
use Aldeebhasan\Emigrate\Logic\Blueprint\MethodPb;
use Aldeebhasan\Emigrate\Logic\Blueprint\TablePb;
use Aldeebhasan\Emigrate\Traits\Makable;

class MigrationManager
{
    use Makable;

    private ColumnManager $columnManager;
    private MethodManager $methodManager;

    public function __construct()
    {
        $this->columnManager = ColumnManager::make();
        $this->methodManager = MethodManager::make();
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
        $tartgetMethod = $this->methodManager->{$method}($value, ...$args);
        return MethodPb::make()->setMethod($tartgetMethod);
    }


    public function generate(string $name, string $action): BlueprintIU
    {
        return (new TablePb())
            ->setName($name)
            ->setAction($action);
    }


}