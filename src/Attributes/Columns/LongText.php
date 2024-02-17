<?php

namespace Aldeebhasan\Emigrate\Attributes\Columns;

use Aldeebhasan\Emigrate\Enums\ColumnTypeEnum;

#[\Attribute(\Attribute::TARGET_PARAMETER)]
class LongText extends Text
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::LONG_TEXT;
}
