<?php

namespace Aldeebhasan\Emigrate\Attributes\Columns;

use Aldeebhasan\Emigrate\Enums\ColumnTypeEnum;

#[\Attribute(\Attribute::TARGET_PARAMETER)]
class Id extends Column
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::ID;

    public function __construct(string $name = 'id')
    {
        return parent::__construct($name);
    }
}
