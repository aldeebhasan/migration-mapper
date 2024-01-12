<?php

namespace Aldeebhasan\Emigrate\Logic\Migration\Columns;

use Aldeebhasan\Emigrate\Enums\ColumnTypeEnum;

class DecimalColumn extends GeneralColumn
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::DECIMAL;

    public function __construct(public string $name, public int $total = 8, public int $places = 2)
    {
    }

    public function toString(): string
    {
        $method = $this->type->value;
        return "$method($this->name,$this->total,$this->places)";
    }

}