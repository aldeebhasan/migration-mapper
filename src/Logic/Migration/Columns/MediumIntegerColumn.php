<?php

namespace Aldeebhasan\Emigrate\Logic\Migration\Columns;

use Aldeebhasan\Emigrate\Enums\ColumnTypeEnum;

class MediumIntegerColumn extends IntegerColumn
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::MEDIUM_INTEGER;
}
