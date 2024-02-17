<?php

namespace Aldeebhasan\MigrationMapper\Attributes;

#[\Attribute(\Attribute::TARGET_CLASS)]
class Table extends EAttribute
{
    public function __construct(public ?string $name = null, public array $columns = [])
    {
    }
}
