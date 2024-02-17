<?php

namespace Aldeebhasan\Emigrate\Logic\Migration\Columns;

use Aldeebhasan\Emigrate\Enums\ColumnTypeEnum;

class MediumTextColumn extends TextColumn
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::MEDIUM_TEXT;
}
