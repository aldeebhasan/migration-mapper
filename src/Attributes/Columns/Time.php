<?php

namespace Aldeebhasan\Emigrate\Attributes\Columns;

use Aldeebhasan\Emigrate\Enums\ColumnTypeEnum;

#[\Attribute(\Attribute::TARGET_PARAMETER)]
class Time extends Column
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::TIME;
}
