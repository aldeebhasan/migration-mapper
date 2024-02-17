<?php

namespace Aldeebhasan\Emigrate\Logic\Migration\Columns;

use Aldeebhasan\Emigrate\Enums\ColumnTypeEnum;

class TinyTextColumn extends TextColumn
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::TINY_TEXT;
}
