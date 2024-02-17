<?php

namespace Aldeebhasan\Emigrate\Attributes\Columns;

use Aldeebhasan\Emigrate\Enums\ColumnTypeEnum;

#[\Attribute(\Attribute::TARGET_PARAMETER)]
class BigInteger extends Integer
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::BIG_INTEGER;
}
