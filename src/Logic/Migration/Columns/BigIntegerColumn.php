<?php

namespace Aldeebhasan\Emigrate\Logic\Migration\Columns;

use Aldeebhasan\Emigrate\Enums\ColumnTypeEnum;

class BigIntegerColumn extends IntegerColumn
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::BIG_INTEGER;
}