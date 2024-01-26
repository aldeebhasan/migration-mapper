<?php

namespace Aldeebhasan\Emigrate\Logic\Migration\Columns;

use Aldeebhasan\Emigrate\Enums\ColumnTypeEnum;

class DropColumnColumn extends GeneralColumn
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::DROP_COLUMN;
}
