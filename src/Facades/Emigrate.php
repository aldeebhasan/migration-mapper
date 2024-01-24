<?php

namespace Aldeebhasan\Emigrate\Facades;

use Aldeebhasan\Emigrate\EmigrateManager;
use Illuminate\Support\Facades\Facade;

/**
 * @method static void generateMigration():
 * @method static void regenerateMigration():
 * @see EmigrateManager
 */
class Emigrate extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'emigrate';
    }
}
