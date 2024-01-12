<?php

namespace Aldeebhasan\Emigrate\Traits;

trait Makable
{

    public static function make(...$args): self
    {
        return new static(...$args);
    }

}