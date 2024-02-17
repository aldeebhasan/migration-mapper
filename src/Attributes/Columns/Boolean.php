<?php

namespace Aldeebhasan\MigrationMapper\Attributes\Columns;

use Aldeebhasan\MigrationMapper\Enums\ColumnTypeEnum;

#[\Attribute(\Attribute::TARGET_PARAMETER)]
class Boolean extends Column
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::BOOLEAN;
}
