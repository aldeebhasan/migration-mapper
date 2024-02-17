<?php

namespace Aldeebhasan\MigrationMapper\Logic\Migration\Columns;

use Aldeebhasan\MigrationMapper\Enums\ColumnTypeEnum;

class MediumTextColumn extends TextColumn
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::MEDIUM_TEXT;
}
