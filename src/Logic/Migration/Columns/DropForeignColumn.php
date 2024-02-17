<?php

namespace Aldeebhasan\MigrationMapper\Logic\Migration\Columns;

use Aldeebhasan\MigrationMapper\Enums\ColumnTypeEnum;

class DropForeignColumn extends GeneralColumn
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::DROP_FOREIGN;

    public function toString(): string
    {
        $method = $this->type->value;

        return "$method(['$this->name'])";
    }
}
