<?php

namespace Aldeebhasan\Emigrate\Test\Unit;

use Aldeebhasan\Emigrate\EmigrateManager;
use Aldeebhasan\Emigrate\Logic\Migration\ColumnFactory;
use Aldeebhasan\Emigrate\Logic\Migration\MethodFactory;
use Aldeebhasan\Emigrate\Logic\Migration\MigrationManager;
use Aldeebhasan\Emigrate\Test\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class EmigrateTest extends TestCase
{
    use WithFaker;

    private $x = 1;

    function test_a()
    {
//        $manger = MigrationManager::make();
//
//        dd($manger->makeMethod('nullable')->toString());
        EmigrateManager::make()->generateMigration();

    }

}
