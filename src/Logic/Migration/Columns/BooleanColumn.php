<?php

namespace Aldeebhasan\MigrationMapper\Logic\Migration\Columns;

use Aldeebhasan\MigrationMapper\Enums\ColumnTypeEnum;

class BooleanColumn extends GeneralColumn
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::BOOLEAN;
}
