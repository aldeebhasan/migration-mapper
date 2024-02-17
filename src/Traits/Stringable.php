<?php

namespace Aldeebhasan\MigrationMapper\Traits;

trait Stringable
{
    public function toString(): string
    {
        return class_basename($this);
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}
