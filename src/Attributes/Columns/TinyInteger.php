<?php

namespace Aldeebhasan\MigrationMapper\Attributes\Columns;

use Aldeebhasan\MigrationMapper\Enums\ColumnTypeEnum;

#[\Attribute(\Attribute::TARGET_PARAMETER)]
class TinyInteger extends Integer
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::TINY_INTEGER;
}
