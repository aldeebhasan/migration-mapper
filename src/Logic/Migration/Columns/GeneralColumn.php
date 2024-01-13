<?php

namespace Aldeebhasan\Emigrate\Logic\Migration\Columns;

use Aldeebhasan\Emigrate\Enums\ColumnTypeEnum;

class GeneralColumn
{
    protected ColumnTypeEnum $type;
    protected string $default = '';

    public function __construct(public string $name)
    {
    }

    public function toString(): string
    {
        $method = $this->type->value;
        return $this->default === $this->name ? "$method()" : "$method('$this->name')";
    }


}