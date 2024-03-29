<?php

namespace Aldeebhasan\MigrationMapper\Logic\Migration\Columns;

use Aldeebhasan\MigrationMapper\Enums\ColumnTypeEnum;

class SoftDeleteColumn extends GeneralColumn
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::SOFT_DELETE;

    protected string $default = 'deleted_at';

    public function __construct(public string $name = 'deleted_at')
    {
    }
}
