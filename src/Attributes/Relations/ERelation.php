<?php

namespace Aldeebhasan\Emigrate\Attributes\Relations;

use Aldeebhasan\Emigrate\Attributes\EAttribute;

#[\Attribute(\Attribute::TARGET_FUNCTION | \Attribute::TARGET_METHOD)]
class ERelation extends EAttribute
{

    public function __construct(public string $relation)
    {
    }

    protected function getFK(string $related): string
    {
        return app($related)->getKeyName();
    }
}
