<?php

namespace Aldeebhasan\Emigrate\Attributes\Columns;

use Aldeebhasan\Emigrate\Enums\ColumnTypeEnum;

#[\Attribute(\Attribute::TARGET_PARAMETER)]
class Boolean extends Column
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::BOOLEAN;
}
