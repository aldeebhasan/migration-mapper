<?php

namespace Aldeebhasan\Emigrate\Logic\Migration\Columns;

use Aldeebhasan\Emigrate\Enums\ColumnTypeEnum;

class TimeColumn extends GeneralColumn
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::TIME;
}
