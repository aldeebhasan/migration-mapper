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

    protected function template(): string
    {
        return '->'.$this->method->toString();
    }

    protected function reverseTemplate(): string
    {
        return '';
    }
}
