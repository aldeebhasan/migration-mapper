<?php

namespace Aldeebhasan\Emigrate\Attributes\Columns;

use Aldeebhasan\Emigrate\Enums\ColumnTypeEnum;

#[\Attribute(\Attribute::TARGET_PARAMETER)]
class TinyInteger extends Integer
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::TINY_INTEGER;
}
