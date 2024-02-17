<?php

namespace Aldeebhasan\MigrationMapper\Attributes\Columns;

use Aldeebhasan\MigrationMapper\Enums\ColumnTypeEnum;

#[\Attribute(\Attribute::TARGET_PARAMETER)]
class Double extends Decimal
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::DOUBLE;
}
