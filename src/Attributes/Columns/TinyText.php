<?php

namespace Aldeebhasan\MigrationMapper\Attributes\Columns;

use Aldeebhasan\MigrationMapper\Enums\ColumnTypeEnum;

#[\Attribute(\Attribute::TARGET_PARAMETER)]
class TinyText extends Text
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::TINY_TEXT;
}
