<?php

namespace Aldeebhasan\Emigrate\Attributes\Columns;

use Aldeebhasan\Emigrate\Enums\ColumnTypeEnum;

#[\Attribute(\Attribute::TARGET_PARAMETER)]
class TinyText extends Text
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::TINY_TEXT;
}
