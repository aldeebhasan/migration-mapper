<?php

namespace Aldeebhasan\Emigrate\Attributes\Columns;

use Aldeebhasan\Emigrate\Enums\ColumnTypeEnum;

#[\Attribute(\Attribute::TARGET_PARAMETER)]
class Decimal extends Column
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::DECIMAL;

    public function __construct(
        string $name,
        public int $total = 8,
        public int $places = 2,
        public bool $nullable = false,
        public mixed $default = null,
        public bool $index = false,
        public bool $unique = false,
        public string $comment = '',
        public bool $unsigned = false,
        public bool $autoIncrement = false,
    )
    {
        return parent::__construct($name);
    }

    public function getProperties(): array
    {
        return [
            $this->total,
            $this->places,
        ];
    }
}
