<?php

namespace Aldeebhasan\Emigrate\Logic\Migration\Columns;

use Aldeebhasan\Emigrate\Enums\ColumnTypeEnum;

class ForeignColumn extends GeneralColumn
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::FOREIGN;
}
