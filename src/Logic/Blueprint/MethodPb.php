<?php

namespace Aldeebhasan\MigrationMapper\Logic\Blueprint;

use Aldeebhasan\MigrationMapper\Enums\MethodTypeEnum;
use Aldeebhasan\MigrationMapper\Logic\Migration\Methods\GeneralMethod;

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
