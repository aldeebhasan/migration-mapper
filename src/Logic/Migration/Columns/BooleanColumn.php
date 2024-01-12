<?php

namespace Aldeebhasan\Emigrate\Logic\Migration\Columns;

use Aldeebhasan\Emigrate\Enums\ColumnTypeEnum;

class BooleanColumn extends GeneralColumn
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::BOOLEAN;

}