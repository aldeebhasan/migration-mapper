<?php

namespace Aldeebhasan\Emigrate\Logic\Migration\Columns;

use Aldeebhasan\Emigrate\Enums\ColumnTypeEnum;

class TextColumn extends GeneralColumn
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::TEXT;
}