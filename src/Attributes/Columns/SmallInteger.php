<?php

namespace Aldeebhasan\MigrationMapper\Attributes\Columns;

use Aldeebhasan\MigrationMapper\Enums\ColumnTypeEnum;

#[\Attribute(\Attribute::TARGET_PARAMETER)]
class SmallInteger extends Integer
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::SMALL_INTEGER;
}
