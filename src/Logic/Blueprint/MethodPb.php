<?php

namespace Aldeebhasan\Emigrate\Logic\Blueprint;

use Aldeebhasan\Emigrate\Logic\Migration\Methods\GeneralMethod;

class MethodPb extends BaseBlueprint
{
    private GeneralMethod $method;

    public function setMethod(GeneralMethod $method): self
    {
        $this->method = $method;
        return $this;
    }

    public function template(): string
    {
        return "->" . $this->method->toString();
    }

    public function toString(): string
    {
        return $this->template();
    }
}