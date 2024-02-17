<?php

namespace Aldeebhasan\Emigrate\Logic\Migration\Columns;

use Aldeebhasan\Emigrate\Enums\ColumnTypeEnum;

class SmallIntegerColumn extends IntegerColumn
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::SMALL_INTEGER;
}
