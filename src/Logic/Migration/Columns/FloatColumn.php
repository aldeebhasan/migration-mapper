<?php

namespace Aldeebhasan\Emigrate\Logic\Migration\Columns;

use Aldeebhasan\Emigrate\Enums\ColumnTypeEnum;

class FloatColumn extends DecimalColumn
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::FLOAT;
}
