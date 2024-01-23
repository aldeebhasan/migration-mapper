<?php

namespace Aldeebhasan\Emigrate\Contracts;

interface TypeIU
{
    public function getKey(): string;

    public function getMethodName(): string;

    public function getArguments(): array;
}
