<?php

namespace Aldeebhasan\Emigrate;

use Aldeebhasan\LaravelCacheFlusher\Facades\Emigrate;
use Illuminate\Cache\Events\KeyForgotten;
use Illuminate\Cache\Events\KeyWritten;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class EmigrateProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/emigrate.php' => config_path('emigrate.php'),
        ], 'emigrate-config');

    }

    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/emigrate.php',
            'emigrate-config'
        );
        $this->app->singleton('emigrate', EmigrateManager::class, );
    }

}
