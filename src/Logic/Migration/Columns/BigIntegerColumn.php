<?php

namespace Aldeebhasan\Emigrate\Logic\Migration\Columns;

use Aldeebhasan\Emigrate\Enums\ColumnTypeEnum;

class BigIntegerColumn extends GeneralColumn
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::BIG_INTEGER;
}
