<?php

namespace Aldeebhasan\Emigrate\Attributes\Columns;

use Aldeebhasan\Emigrate\Enums\ColumnTypeEnum;

#[\Attribute(\Attribute::TARGET_PARAMETER)]
class Decimal extends Column
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::DECIMAL;

    public function __construct(
        string         $name,
        protected int  $total = 8,
        protected int  $places = 2,
        bool           $nullable = false,
        mixed          $default = null,
        bool           $index = false,
        bool           $unique = false,
        string         $comment = '',
        protected bool $unsigned = false,
        protected bool $autoIncrement = false,
    )
    {
        return parent::__construct($name, $nullable, $default, $index, $unique, $comment);
    }

    public function getProperties(): array
    {
        return [
            $this->total,
            $this->places,
        ];
    }
}
