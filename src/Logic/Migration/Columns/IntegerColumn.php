<?php

namespace Aldeebhasan\MigrationMapper\Logic\Migration\Columns;

use Aldeebhasan\MigrationMapper\Enums\ColumnTypeEnum;

class IntegerColumn extends GeneralColumn
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::INTEGER;
}
