<?php

namespace Aldeebhasan\Emigrate\Logic\Migration\Columns;

use Aldeebhasan\Emigrate\Enums\ColumnTypeEnum;

class DateColumn extends GeneralColumn
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::DATE;
}
