<?php

namespace Aldeebhasan\MigrationMapper\Test;

use Aldeebhasan\MigrationMapper\MigrationMapperProvider;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app): array
    {
        return [MigrationMapperProvider::class];
    }

    protected function getEnvironmentSetUp($app)
    {
        $path = realpath(__DIR__ . '/Unit/Models');
        $app['config']->set('migration-mapper.models_paths', [$path]);

    }
}
