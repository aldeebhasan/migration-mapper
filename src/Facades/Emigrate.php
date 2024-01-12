<?php

namespace Aldeebhasan\Emigrate\Facades;

use Aldeebhasan\Emigrate\EmigrateManager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Facade;

/**
 * @method static void initialize()
 * @method static bool enabled()
 * @method static void put(string $key)
 * @method static void forget(string|int|array $forgetKey)
 * @method static void flush()
 * @method static void process(Model $model)
 * @method static void setBindingFunction(\Closure $closure)
 * @see EmigrateManager
 */
class Emigrate extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'emigrate';
    }
}
