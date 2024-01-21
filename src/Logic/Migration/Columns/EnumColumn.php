<?php

namespace Aldeebhasan\Emigrate\Logic\Migration\Columns;

use Aldeebhasan\Emigrate\Enums\ColumnTypeEnum;

class EnumColumn extends GeneralColumn
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::ENUM;

    public function __construct(public string $name, public array $allowed = [])
    {
    }

    public function toString(): string
    {
        $method = $this->type->value;
        $options = implode(', ', $this->allowed);
        return "$method('$this->name',[$options])";
    }

}