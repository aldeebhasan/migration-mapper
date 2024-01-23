<?php

namespace Aldeebhasan\Emigrate\Logic\Blueprint;

use Aldeebhasan\Emigrate\Traits\Makable;

abstract class BaseBlueprint implements BlueprintIU
{
    use Makable;

    public static string $slot = '{{ slot }}';

    public static string $tab = "\t";

    /**
     * @var BlueprintIU[]
     */
    protected array $chains = [];

    public function chain(BlueprintIU $item): self
    {
        $this->chains[] = $item;

        return $this;
    }

    abstract protected function template(): string;

    abstract protected function reverseTemplate(): string;

    public function toString(): string
    {
        return $this->template();
    }

    public function toStringReversed(): string
    {
        return $this->reverseTemplate();
    }
}
