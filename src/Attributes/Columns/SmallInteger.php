<?php

namespace Aldeebhasan\Emigrate\Attributes\Columns;

use Aldeebhasan\Emigrate\Enums\ColumnTypeEnum;

#[\Attribute(\Attribute::TARGET_PARAMETER)]
class SmallInteger extends Integer
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::SMALL_INTEGER;
}
