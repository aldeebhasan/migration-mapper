<?php

namespace Aldeebhasan\Emigrate\Logic\Migration\Columns;

use Aldeebhasan\Emigrate\Enums\ColumnTypeEnum;

class DropForeignColumn extends GeneralColumn
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::DROP_FOREIGN;
}
