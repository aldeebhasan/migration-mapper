<?php

namespace Aldeebhasan\MigrationMapper\Logic\Migration\Columns;

use Aldeebhasan\MigrationMapper\Enums\ColumnTypeEnum;

class TextColumn extends GeneralColumn
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::TEXT;
}
