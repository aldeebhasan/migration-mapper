<?php

namespace Aldeebhasan\Emigrate\Attributes\Relations;

use Aldeebhasan\Emigrate\Enums\RelationTypeEnum;

#[\Attribute(\Attribute::TARGET_FUNCTION | \Attribute::TARGET_METHOD)]
class ManyToOne extends ERelation
{
    public function __construct(public string $related, public ?string $fk = null, public ?string $lk = null)
    {
        parent::__construct(RelationTypeEnum::MANY_TO_ONE->value);
        if (!$this->fk) {
            $this->fk = $this->getFK($this->related);
        }
    }
}
