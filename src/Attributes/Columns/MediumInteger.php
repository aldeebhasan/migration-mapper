<?php

namespace Aldeebhasan\MigrationMapper\Attributes\Columns;

use Aldeebhasan\MigrationMapper\Enums\ColumnTypeEnum;

#[\Attribute(\Attribute::TARGET_PARAMETER)]
class MediumInteger extends Integer
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::MEDIUM_INTEGER;
}
