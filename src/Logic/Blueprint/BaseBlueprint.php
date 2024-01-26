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

    public function unChain(BlueprintIU $item): self
    {
        foreach ($this->chains as $key => $chain) {
            if ($chain->equal($item)) {
                unset($this->chains[$key]);
                break;
            }
        }

        return $this;
    }

    public function isEmpty(): bool
    {
        return empty($this->chains);
    }

    abstract protected function template(): string;

    abstract protected function reverseTemplate(?TablePb $last): string;

    abstract public function getName(): string;

    public function equal(BlueprintIU $item): bool
    {
        return $item->getName() === $this->getName();
    }

    public function toString(): string
    {
        return $this->template();
    }

    public function toStringReversed(?BlueprintIU $last): string
    {
        return $this->reverseTemplate($last);
    }
}
