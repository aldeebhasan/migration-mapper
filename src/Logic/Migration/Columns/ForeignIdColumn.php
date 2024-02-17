<?php

namespace Aldeebhasan\Emigrate\Logic\Migration\Columns;

use Aldeebhasan\Emigrate\Enums\ColumnTypeEnum;

class ForeignIdColumn extends GeneralColumn
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::FOREIGN_ID;
}
