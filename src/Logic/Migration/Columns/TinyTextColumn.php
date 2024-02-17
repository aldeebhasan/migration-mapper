<?php

namespace Aldeebhasan\MigrationMapper\Logic\Migration\Columns;

use Aldeebhasan\MigrationMapper\Enums\ColumnTypeEnum;

class TinyTextColumn extends TextColumn
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::TINY_TEXT;
}
