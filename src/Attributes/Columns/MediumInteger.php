<?php

namespace Aldeebhasan\Emigrate\Attributes\Columns;

use Aldeebhasan\Emigrate\Enums\ColumnTypeEnum;

#[\Attribute(\Attribute::TARGET_PARAMETER)]
class MediumInteger extends Integer
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::MEDIUM_INTEGER;
}
