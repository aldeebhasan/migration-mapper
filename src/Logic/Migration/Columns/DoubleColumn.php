<?php

namespace Aldeebhasan\Emigrate\Logic\Migration\Columns;

use Aldeebhasan\Emigrate\Enums\ColumnTypeEnum;

class DoubleColumn extends DecimalColumn
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::DOUBLE;
}
