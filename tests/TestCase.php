<?php

namespace Aldeebhasan\Emigrate\Test;

use Aldeebhasan\Emigrate\EmigrateProvider;
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
        return [EmigrateProvider::class];
    }

    protected function getEnvironmentSetUp($app)
    {
        $path = realpath(__DIR__ . '/Unit/Models');
        $app['config']->set('emigrate.model_paths', [$path]);

    }
}
