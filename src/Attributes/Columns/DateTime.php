<?php

namespace Aldeebhasan\Emigrate\Attributes\Columns;

use Aldeebhasan\Emigrate\Enums\ColumnTypeEnum;

#[\Attribute(\Attribute::TARGET_PARAMETER)]
class DateTime extends Column
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::DATETIME;
}
