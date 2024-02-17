<?php

namespace Aldeebhasan\MigrationMapper\Logic\Migration\Columns;

use Aldeebhasan\MigrationMapper\Enums\ColumnTypeEnum;

class ForeignIdColumn extends GeneralColumn
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::FOREIGN_ID;
}
