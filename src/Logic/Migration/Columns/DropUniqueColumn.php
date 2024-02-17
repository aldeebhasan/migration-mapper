<?php

namespace Aldeebhasan\MigrationMapper\Logic\Migration\Columns;

use Aldeebhasan\MigrationMapper\Enums\ColumnTypeEnum;

class DropUniqueColumn extends DropForeignColumn
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::DROP_UNIQUE;
}
