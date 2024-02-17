<?php

namespace Aldeebhasan\MigrationMapper\Logic\Migration\Columns;

use Aldeebhasan\MigrationMapper\Enums\ColumnTypeEnum;

class FloatColumn extends DecimalColumn
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::FLOAT;
}
