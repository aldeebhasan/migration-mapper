<?php

namespace Aldeebhasan\Emigrate\Attributes\Columns;

use Aldeebhasan\Emigrate\Enums\ColumnTypeEnum;

#[\Attribute(\Attribute::TARGET_PARAMETER)]
class Integer extends Column
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::INTEGER;

    public function __construct(
        string         $name,
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
}
