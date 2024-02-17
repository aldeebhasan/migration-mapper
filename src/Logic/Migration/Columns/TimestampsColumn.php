<?php

namespace Aldeebhasan\MigrationMapper\Logic\Migration\Columns;

use Aldeebhasan\MigrationMapper\Enums\ColumnTypeEnum;

class TimestampsColumn extends GeneralColumn
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::TIMESTAMPS;

    protected string $default = '';

    public function __construct(public string $name = '')
    {
    }
}
