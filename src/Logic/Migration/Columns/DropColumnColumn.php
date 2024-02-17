<?php

namespace Aldeebhasan\MigrationMapper\Logic\Migration\Columns;

use Aldeebhasan\MigrationMapper\Enums\ColumnTypeEnum;

class DropColumnColumn extends GeneralColumn
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::DROP_COLUMN;
}
