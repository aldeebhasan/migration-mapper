<?php

namespace Aldeebhasan\MigrationMapper\Attributes\Columns;

use Aldeebhasan\MigrationMapper\Enums\ColumnTypeEnum;

#[\Attribute(\Attribute::TARGET_PARAMETER)]
class Text extends Column
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::TEXT;
}
