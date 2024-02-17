<?php

namespace Aldeebhasan\MigrationMapper\Attributes\Columns;

use Aldeebhasan\MigrationMapper\Enums\ColumnTypeEnum;

#[\Attribute(\Attribute::TARGET_PARAMETER)]
class Id extends Column
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::ID;

    public function __construct(string $name = 'id')
    {
        return parent::__construct($name);
    }
}
