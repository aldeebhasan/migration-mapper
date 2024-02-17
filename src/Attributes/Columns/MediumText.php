<?php

namespace Aldeebhasan\MigrationMapper\Attributes\Columns;

use Aldeebhasan\MigrationMapper\Enums\ColumnTypeEnum;

#[\Attribute(\Attribute::TARGET_PARAMETER)]
class MediumText extends Text
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::MEDIUM_TEXT;
}
