<?php

namespace Aldeebhasan\MigrationMapper\Logic\Blueprint;

interface BlueprintIU
{
    public function equal(self $item): bool;

    public function getName(): string;

    public function toString(): string;

    public function toStringReversed(?self $last): string;
}
