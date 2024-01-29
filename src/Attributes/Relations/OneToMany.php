<?php

namespace Aldeebhasan\Emigrate\Attributes\Relations;

use Aldeebhasan\Emigrate\Enums\RelationTypeEnum;

#[\Attribute(\Attribute::TARGET_FUNCTION | \Attribute::TARGET_METHOD)]
class OneToMany extends ERelation
{
    public function __construct(public string $related, public ?string $fk = null, public ?string $lk = null)
    {
        parent::__construct(RelationTypeEnum::ONE_TO_MANY->value);
        if (!$this->fk) {
            $this->fk = $this->getFK($this->related);
        }
    }
}
