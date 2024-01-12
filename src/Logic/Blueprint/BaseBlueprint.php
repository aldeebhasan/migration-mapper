<?php

namespace Aldeebhasan\Emigrate\Logic\Blueprint;

use Aldeebhasan\Emigrate\Traits\Makable;

abstract class BaseBlueprint implements BlueprintIU
{
    use Makable;

    public static string $slot = '{{ slot }}';

    /**
     * @var BlueprintIU[]
     */
    protected array $chains = [];


    public function chain(BlueprintIU $item): self
    {
        $this->chains[] = $item;
        return $this;
    }
}