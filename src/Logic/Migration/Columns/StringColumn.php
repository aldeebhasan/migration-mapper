<?php

namespace Aldeebhasan\Emigrate\Logic\Migration\Columns;

use Aldeebhasan\Emigrate\Enums\ColumnTypeEnum;

class StringColumn extends GeneralColumn
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::STRING;

    protected $defaultLength = 255;


    public function __construct(public string $name, public int $length = 255)
    {
    }

    public function toString(): string
    {
        $method = $this->type->value;
        $params = "'$this->name'";
        if ($this->length !== $this->defaultLength) {
            $params = "'$this->name', $this->length";
        }

        return "$method($params)";
    }
}
