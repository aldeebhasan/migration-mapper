<?php

namespace Aldeebhasan\MigrationMapper\Attributes\Columns;

use Aldeebhasan\MigrationMapper\Enums\ColumnTypeEnum;

#[\Attribute(\Attribute::TARGET_PARAMETER)]
class BigInteger extends Integer
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::BIG_INTEGER;
}
