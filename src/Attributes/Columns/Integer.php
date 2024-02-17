<?php

namespace Aldeebhasan\Emigrate\Attributes\Columns;

use Aldeebhasan\Emigrate\Enums\ColumnTypeEnum;

#[\Attribute(\Attribute::TARGET_PARAMETER)]
class Integer extends Column
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::INTEGER;

    public function __construct(
        string $name,
        protected bool $nullable = false,
        protected mixed $default = null,
        protected bool $index = false,
        protected bool $unique = false,
        protected string $comment = '',
        protected bool $unsigned = false,
        protected bool $autoIncrement = false,
    )
    {
        return parent::__construct($name);
    }
}
