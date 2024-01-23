<?php

namespace Aldeebhasan\Emigrate\Logic\Migration\Columns;

use Aldeebhasan\Emigrate\Enums\ColumnTypeEnum;

class DateTimeColumn extends GeneralColumn
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::DATETIME;
}
