<?php

namespace Aldeebhasan\MigrationMapper\Logic\Migration\Columns;

use Aldeebhasan\MigrationMapper\Enums\ColumnTypeEnum;

class LongTextColumn extends TextColumn
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::LONG_TEXT;
}
