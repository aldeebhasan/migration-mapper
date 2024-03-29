<?php

namespace Aldeebhasan\MigrationMapper\Logic\Migration\Columns;

use Aldeebhasan\MigrationMapper\Enums\ColumnTypeEnum;

class GeneralColumn
{
    protected ColumnTypeEnum $type;

    protected string $default = '';

    public function __construct(public string $name)
    {
    }

    public function is(ColumnTypeEnum $type): bool
    {
        return $this->type === $type;
    }

    public function toString(): string
    {
        $method = $this->type->value;

        return $this->default === $this->name ? "$method()" : "$method('$this->name')";
    }
}
