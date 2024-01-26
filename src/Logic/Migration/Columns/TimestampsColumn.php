<?php

namespace Aldeebhasan\Emigrate\Logic\Migration\Columns;

use Aldeebhasan\Emigrate\Enums\ColumnTypeEnum;

class TimestampsColumn extends GeneralColumn
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::TIMESTAMPS;

    protected string $default = '';

    public function __construct(public string $name = '')
    {
    }
}
