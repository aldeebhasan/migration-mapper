<?php

namespace Aldeebhasan\MigrationMapper\Facades;

use Aldeebhasan\MigrationMapper\MigrationMapperManager;
use Illuminate\Support\Facades\Facade;

/**
 * @method static array generateMigration():
 * @method static array regenerateMigration():
 * @method static void rollbackMigration():
 * @see MigrationMapperManager
 */
class MigrationMapper extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'migration-mapper';
    }
}
