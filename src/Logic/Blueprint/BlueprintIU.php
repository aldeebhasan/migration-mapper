<?php

namespace Aldeebhasan\Emigrate\Logic\Blueprint;

interface BlueprintIU
{
    public function equal(BlueprintIU $item): bool;

    public function getName(): string;

    public function toString(): string;

    public function toStringReversed(?BlueprintIU $last): string;
}
