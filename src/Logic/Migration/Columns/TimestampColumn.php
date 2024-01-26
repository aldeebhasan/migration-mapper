<?php

namespace Aldeebhasan\Emigrate\Logic\Migration\Columns;

use Aldeebhasan\Emigrate\Enums\ColumnTypeEnum;

class TimestampColumn extends GeneralColumn
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::TIMESTAMP;
}
