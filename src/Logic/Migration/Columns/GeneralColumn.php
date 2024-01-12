<?php

namespace Aldeebhasan\Emigrate\Logic\Migration\Columns;

use Aldeebhasan\Emigrate\Enums\ColumnTypeEnum;

class GeneralColumn
{
    protected ColumnTypeEnum $type;

    public function __construct(public string $name)
    {
    }

    public function toString(): string
    {
        $method = $this->type->value;
        return "$method($this->name)";

    }


}