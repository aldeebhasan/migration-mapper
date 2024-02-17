<?php

namespace Aldeebhasan\MigrationMapper\Logic\Migration\Columns;

use Aldeebhasan\MigrationMapper\Enums\ColumnTypeEnum;

class EnumColumn extends GeneralColumn
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::ENUM;

    public function __construct(public string $name, public array $allowed = [])
    {
    }

    public function toString(): string
    {
        $method = $this->type->value;
        $allowed = array_map(fn ($x) => "'$x'", $this->allowed);
        $options = implode(', ', $allowed);

        return "$method('$this->name', [$options])";
    }
}
