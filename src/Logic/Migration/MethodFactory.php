<?php

namespace Aldeebhasan\Emigrate\Logic\Migration;

use Aldeebhasan\Emigrate\Logic\Migration\Methods\GeneralMethod;
use Aldeebhasan\Emigrate\Traits\Makable;

/**
 * @method GeneralMethod default(mixed $value = '')
 * @method GeneralMethod nullable()
 * @method GeneralMethod index(mixed $value = '')
 * @method GeneralMethod unsigned()
 * @method GeneralMethod autoIncrement()
 * @method GeneralMethod comment(string $value = '')
 * @method GeneralMethod unique()
 * @method GeneralMethod fulltext(mixed $value = '')
 * @method GeneralMethod useCurrent()
 * @method GeneralMethod change()
 * @method GeneralMethod references(string $value)
 * @method GeneralMethod on(string $value)
 */
class MethodFactory
{
    use Makable;

    public function __call(string $name, array $arguments)
    {
        $baseName = str($name)->title()->toString();
        $namespace = 'Aldeebhasan\\Emigrate\\Logic\\Migration\\Methods\\';
        $className = $namespace.$baseName.'Method';

        if (! class_exists($className)) {
            throw new \Exception("Unsupported method name: $name!");
        }

        return $this->handleClassInitialization($className, $arguments);
    }

    private function handleClassInitialization(string $class, array $arguments): GeneralMethod
    {
        $value = $arguments[0] ?? '';

        return $value || is_numeric($value) ? new $class($value) : new $class();
    }
}
