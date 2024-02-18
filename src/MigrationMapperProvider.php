<?php

namespace Aldeebhasan\MigrationMapper;

use Aldeebhasan\MigrationMapper\Commands\GenerateMigrationsCommand;
use Aldeebhasan\MigrationMapper\Commands\RegenerateMigrationsCommand;
use Aldeebhasan\MigrationMapper\Commands\RollbackMigrationsCommand;
use Illuminate\Support\ServiceProvider;

class MigrationMapperProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/migration-mapper.php' => config_path('migration-mapper.php'),
        ], 'migration-mapper-config');

        $this->commands([
            GenerateMigrationsCommand::class,
            RegenerateMigrationsCommand::class,
            RollbackMigrationsCommand::class,
        ]);

    }

    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/migration-mapper.php',
            'migration-mapper'
        );
        $this->app->singleton('migration-mapper', MigrationMapperManager::class, );
    }
}
