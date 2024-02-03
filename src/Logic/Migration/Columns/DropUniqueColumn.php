<?php

namespace Aldeebhasan\Emigrate\Logic\Migration\Columns;

use Aldeebhasan\Emigrate\Enums\ColumnTypeEnum;

class DropUniqueColumn extends DropForeignColumn
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::DROP_UNIQUE;

}
