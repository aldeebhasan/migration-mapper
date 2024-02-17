<?php

namespace Aldeebhasan\Emigrate\Attributes\Columns;

use Aldeebhasan\Emigrate\Enums\ColumnTypeEnum;

#[\Attribute(\Attribute::TARGET_PARAMETER)]
class Double extends Decimal
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::DOUBLE;
}
