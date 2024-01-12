<?php

namespace Aldeebhasan\Emigrate\Test\Unit;

use Aldeebhasan\Emigrate\EmigrateManager;
use Aldeebhasan\Emigrate\Test\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class EmigrateTest extends TestCase
{
    use WithFaker;
    private $x=1;
    function test_a()
    {

        $str = <<<EOD
                Schema::create('$this->x', function (Blueprint \$table) {
                   
                });
                EOD;
        dd($str);
        EmigrateManager::make()->generateMigration();

    }

}
