<?php

namespace Aldeebhasan\MigrationMapper\Attributes\Relations;

use Aldeebhasan\MigrationMapper\Attributes\EAttribute;

#[\Attribute(\Attribute::TARGET_FUNCTION | \Attribute::TARGET_METHOD)]
class ERelation extends EAttribute
{
    public function __construct(public string $type)
    {
    }
}
