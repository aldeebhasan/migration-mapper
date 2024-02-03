<?php

namespace Aldeebhasan\Emigrate\Logic\Migration\Columns;

use Aldeebhasan\Emigrate\Enums\ColumnTypeEnum;

class DropFulltextColumn extends DropForeignColumn
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::DROP_FULLTEXT;
}
