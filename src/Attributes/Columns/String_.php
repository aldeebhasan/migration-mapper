<?php

namespace Aldeebhasan\MigrationMapper\Attributes\Columns;

use Aldeebhasan\MigrationMapper\Enums\ColumnTypeEnum;

#[\Attribute(\Attribute::TARGET_PARAMETER)]
class String_ extends Column
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::STRING;

    public function __construct(
        string $name,
        protected int $length = 255,
        bool $nullable = false,
        mixed $default = null,
        bool $index = false,
        bool $unique = false,
        string $comment = '',
    )
    {
        return parent::__construct($name, $nullable, $default, $index, $unique, $comment);
    }

    public function getProperties(): array
    {
        return [
            $this->length,
        ];
    }
}
