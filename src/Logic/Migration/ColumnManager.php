<?php

namespace Aldeebhasan\Emigrate\Logic\Migration;

use Aldeebhasan\Emigrate\Logic\Migration\Columns\DecimalColumn;
use Aldeebhasan\Emigrate\Logic\Migration\Columns\DoubleColumn;
use Aldeebhasan\Emigrate\Logic\Migration\Columns\EnumColumn;
use Aldeebhasan\Emigrate\Logic\Migration\Columns\FloatColumn;
use Aldeebhasan\Emigrate\Logic\Migration\Columns\GeneralColumn;
use Aldeebhasan\Emigrate\Logic\Migration\Columns\StringColumn;
use Aldeebhasan\Emigrate\Traits\Makable;

/**
 * @method GeneralColumn  id(string $name = 'id')
 * @method GeneralColumn boolean(string $name)
 * @method GeneralColumn date(string $name)
 * @method GeneralColumn dateTime(string $name)
 * @method GeneralColumn time(string $name)
 * @method GeneralColumn integer(string $name)
 * @method GeneralColumn softDelete(string $name = 'deleted_at')
 * @method GeneralColumn string(string $name, $length = 255)
 * @method GeneralColumn text(string $name)
 * @method GeneralColumn decimal(string $name, int $total = 8, int $places = 2)
 * @method GeneralColumn float(string $name, int $total = 8, int $places = 2)
 * @method GeneralColumn double(string $name, int $total = 8, int $places = 2)
 * @method GeneralColumn enum(string $name, array $allowed = [])
 */
class ColumnManager
{
    use Makable;


    public function __call(string $name, array $arguments)
    {
        $baseName = str($name)->title()->toString();
        $namespace = "Aldeebhasan\\Emigrate\\Logic\\Migration\\Columns\\";
        $className = $namespace . $baseName . "Column";

        if (!class_exists($className)) {
            throw new \Exception("Unsupported column type!");
        }
        return $this->handleClassInitialization($className, $arguments);
    }

    private function handleClassInitialization(string $class, array $arguments): GeneralColumn
    {
        $name = $arguments[0] ?? "";

        if (in_array($class, [DecimalColumn::class, FloatColumn::class, DoubleColumn::class])) {
            $total = $arguments[1] ?? 8;
            $places = $arguments[2] ?? 2;
            return new $class($name, $total, $places);

        } elseif ($class === EnumColumn::class) {
            $allowed = $arguments[1] ?? [];
            return new $class($name, $allowed);

        } elseif ($class === StringColumn::class) {
            $length = $arguments[1] ?? 255;
            return new $class($name, $length);

        } else {
            return $name ? new $class($name) : new $class();
        }

    }
}