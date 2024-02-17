<?php

namespace Aldeebhasan\Emigrate\Attributes\Columns;

use Aldeebhasan\Emigrate\Enums\ColumnTypeEnum;

#[\Attribute(\Attribute::TARGET_PARAMETER)]
class MediumText extends Text
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::MEDIUM_TEXT;
}
