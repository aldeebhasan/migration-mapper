<?php

namespace Aldeebhasan\MigrationMapper\Test\Unit;

use Aldeebhasan\MigrationMapper\MigrationMapperManager;
use Aldeebhasan\MigrationMapper\Facades\MigrationMapper;
use Aldeebhasan\MigrationMapper\Test\TestCase;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;

class MigrationMapperTest extends TestCase
{
    use WithFaker;

    function test_a()
    {
//        $manger = MigrationManager::make();
//
//        dd($manger->makeMethod('nullable')->toString());
        MigrationMapper::regenerateMigration();
//        MigrationMapper::generateMigration();

//        Artisan::call("mapper:generate");
    }

}
