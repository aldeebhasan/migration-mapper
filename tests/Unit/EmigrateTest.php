<?php

namespace Aldeebhasan\Emigrate\Test\Unit;

use Aldeebhasan\Emigrate\EmigrateManager;
use Aldeebhasan\Emigrate\Facades\Emigrate;
use Aldeebhasan\Emigrate\Test\TestCase;
use Carbon\Carbon;
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
//        Emigrate::regenerateMigration();
        Emigrate::regenerateMigration();

    }

}
