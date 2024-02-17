<?php

namespace Aldeebhasan\MigrationMapper\Attributes\Columns;

use Aldeebhasan\MigrationMapper\Enums\ColumnTypeEnum;

#[\Attribute(\Attribute::TARGET_PARAMETER)]
class LongText extends Text
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::LONG_TEXT;
}
