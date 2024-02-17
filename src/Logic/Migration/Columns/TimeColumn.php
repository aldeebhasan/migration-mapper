<?php

namespace Aldeebhasan\MigrationMapper\Logic\Migration\Columns;

use Aldeebhasan\MigrationMapper\Enums\ColumnTypeEnum;

class TimeColumn extends GeneralColumn
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::TIME;
}
