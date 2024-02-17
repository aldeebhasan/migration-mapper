<?php

namespace Aldeebhasan\Emigrate\Logic\Migration\Columns;

use Aldeebhasan\Emigrate\Enums\ColumnTypeEnum;

class TinyIntegerColumn extends IntegerColumn
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::TINY_INTEGER;
}
