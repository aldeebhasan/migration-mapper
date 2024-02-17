<?php

namespace Aldeebhasan\MigrationMapper\Logic\Migration\Columns;

use Aldeebhasan\MigrationMapper\Enums\ColumnTypeEnum;

class IdColumn extends GeneralColumn
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::ID;

    protected string $default = 'id';

    public function __construct(public string $name = 'id')
    {
    }
}
