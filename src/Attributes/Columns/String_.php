<?php

namespace Aldeebhasan\Emigrate\Attributes\Columns;

use Aldeebhasan\Emigrate\Enums\ColumnTypeEnum;

#[\Attribute(\Attribute::TARGET_PARAMETER)]
class String_ extends Column
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::STRING;

    public function __construct(
        string $name,
        protected int $length = 255,
        protected bool $nullable = false,
        protected mixed $default = null,
        protected bool $index = false,
        protected bool $unique = false,
        protected string $comment = '',
    )
    {
        return parent::__construct($name);
    }

    public function getProperties(): array
    {
        return [
            $this->length,
        ];
    }
}
