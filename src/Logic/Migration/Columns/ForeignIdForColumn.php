<?php

namespace Aldeebhasan\MigrationMapper\Logic\Migration\Columns;

use Aldeebhasan\MigrationMapper\Enums\ColumnTypeEnum;

class ForeignIdForColumn extends GeneralColumn
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::FOREIGN_ID_FOR;

    public function __construct(public string $name, public $column = null)
    {
    }

    public function toString(): string
    {
        $method = $this->type->value;
        $params = "'$this->name'";
        if ($this->column) {
            $params = $params.", '$this->column'";
        }

        return "$method($params)";
    }
}
