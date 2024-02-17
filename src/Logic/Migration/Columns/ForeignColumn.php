<?php

namespace Aldeebhasan\MigrationMapper\Logic\Migration\Columns;

use Aldeebhasan\MigrationMapper\Enums\ColumnTypeEnum;

class ForeignColumn extends GeneralColumn
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::FOREIGN;
}
