<?php

namespace Aldeebhasan\MigrationMapper\Logic\Migration\Columns;

use Aldeebhasan\MigrationMapper\Enums\ColumnTypeEnum;

class TimestampColumn extends GeneralColumn
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::TIMESTAMP;
}
