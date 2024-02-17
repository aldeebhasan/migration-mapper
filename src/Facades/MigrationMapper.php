<?php

namespace Aldeebhasan\MigrationMapper\Facades;

use Aldeebhasan\MigrationMapper\EmigrateManager;
use Illuminate\Support\Facades\Facade;

/**
 * @method static void generateMigration():
 * @method static void regenerateMigration():
 * @see EmigrateManager
 */
class MigrationMapper extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'migration-mapper';
    }
}
