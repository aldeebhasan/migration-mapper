<?php

namespace Aldeebhasan\Emigrate\Attributes\Columns;

use Aldeebhasan\Emigrate\Enums\ColumnTypeEnum;

#[\Attribute(\Attribute::TARGET_PARAMETER)]
class Float_ extends Decimal
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::FLOAT;
}
