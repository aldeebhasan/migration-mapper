<?php

namespace Aldeebhasan\MigrationMapper\Attributes\Columns;

use Aldeebhasan\MigrationMapper\Enums\ColumnTypeEnum;

#[\Attribute(\Attribute::TARGET_PARAMETER)]
class Float_ extends Decimal
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::FLOAT;
}
