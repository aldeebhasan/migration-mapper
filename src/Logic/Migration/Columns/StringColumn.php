<?php

namespace Aldeebhasan\Emigrate\Logic\Migration\Columns;

use Aldeebhasan\Emigrate\Enums\ColumnTypeEnum;

class StringColumn extends GeneralColumn
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::STRING;

    public function __construct(public string $name, public $length = 255)
    {
    }
}
