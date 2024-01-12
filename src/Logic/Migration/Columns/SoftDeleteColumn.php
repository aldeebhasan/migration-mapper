<?php

namespace Aldeebhasan\Emigrate\Logic\Migration\Columns;

use Aldeebhasan\Emigrate\Enums\ColumnTypeEnum;

class SoftDeleteColumn extends GeneralColumn
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::SOFT_DELETE;

    public function __construct(public string $name = "deleted_at")
    {
    }

}