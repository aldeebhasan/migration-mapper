<?php

namespace Aldeebhasan\MigrationMapper\Logic\Migration\Methods;

use Aldeebhasan\MigrationMapper\Enums\MethodTypeEnum;

class GeneralMethod
{
    protected MethodTypeEnum $type;

    public function __construct(protected mixed $value = null)
    {
    }

    public function is(MethodTypeEnum $type): bool
    {
        return $this->type === $type;
    }

    public function getType(): MethodTypeEnum
    {
        return $this->type;
    }

    public function toString(): string
    {
        $method = $this->type->value;

        return ! is_null($this->value) ? "$method('$this->value')" : "$method()";
    }
}
