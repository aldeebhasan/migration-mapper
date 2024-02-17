<?php

namespace Aldeebhasan\MigrationMapper\Logic\Migration\Columns;

use Aldeebhasan\MigrationMapper\Enums\ColumnTypeEnum;

class TinyIntegerColumn extends IntegerColumn
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::TINY_INTEGER;
}
