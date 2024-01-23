<?php

namespace Aldeebhasan\Emigrate\Logic\Migration\Columns;

use Aldeebhasan\Emigrate\Enums\ColumnTypeEnum;

class IntegerColumn extends GeneralColumn
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::INTEGER;
}
