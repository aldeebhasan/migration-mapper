<?php

namespace Aldeebhasan\Emigrate\Logic\Migration\Columns;

use Aldeebhasan\Emigrate\Enums\ColumnTypeEnum;

class DropIndexColumn extends DropForeignColumn
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::DROP_INDEX;
}
