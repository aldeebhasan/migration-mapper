<?php

namespace Aldeebhasan\Emigrate\Logic\Blueprint;

use Aldeebhasan\Emigrate\Enums\MethodTypeEnum;
use Aldeebhasan\Emigrate\Logic\Migration\Methods\GeneralMethod;

class MethodPb extends BaseBlueprint
{
    private GeneralMethod $method;

    public function setMethod(GeneralMethod $method): self
    {
        $this->method = $method;

        return $this;
    }

    public function getName(): string
    {
        return $this->method->getType()->value;
    }

    public function isChange(): bool
    {
        return $this->method->is(MethodTypeEnum::CHANGE);
    }

    protected function template(): string
    {
        return '->'.$this->method->toString();
    }

    protected function reverseTemplate(?BaseBlueprint $last): string
    {
        return $this->template();
    }
}
