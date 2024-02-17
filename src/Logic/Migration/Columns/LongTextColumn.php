<?php

namespace Aldeebhasan\Emigrate\Logic\Migration\Columns;

use Aldeebhasan\Emigrate\Enums\ColumnTypeEnum;

class LongTextColumn extends TextColumn
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::LONG_TEXT;
}
