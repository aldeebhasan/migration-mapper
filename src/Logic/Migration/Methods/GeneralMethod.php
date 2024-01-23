<?php

namespace Aldeebhasan\Emigrate\Logic\Migration\Methods;

use Aldeebhasan\Emigrate\Enums\MethodTypeEnum;

class GeneralMethod
{
    protected MethodTypeEnum $type;

    public function __construct(protected mixed $value = '')
    {
    }

    public function toString(): string
    {
        $method = $this->type->value;

        return $this->value ? "$method('$this->value')" : "$method()";
    }
}
