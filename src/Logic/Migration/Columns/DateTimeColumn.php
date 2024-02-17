<?php

namespace Aldeebhasan\MigrationMapper\Logic\Migration\Columns;

use Aldeebhasan\MigrationMapper\Enums\ColumnTypeEnum;

class DateTimeColumn extends GeneralColumn
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::DATETIME;
}
