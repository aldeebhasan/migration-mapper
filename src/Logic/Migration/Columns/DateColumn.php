<?php

namespace Aldeebhasan\MigrationMapper\Logic\Migration\Columns;

use Aldeebhasan\MigrationMapper\Enums\ColumnTypeEnum;

class DateColumn extends GeneralColumn
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::DATE;
}
