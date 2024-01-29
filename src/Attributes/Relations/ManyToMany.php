<?php

namespace Aldeebhasan\Emigrate\Attributes\Relations;

use Aldeebhasan\Emigrate\Enums\RelationTypeEnum;

#[\Attribute(\Attribute::TARGET_FUNCTION | \Attribute::TARGET_METHOD)]
class ManyToMany extends ERelation
{

    public function __construct(
        public string  $related,
        public string  $table,
        public ?string $fk = null,
        public ?string $lk = null)
    {
        parent::__construct(RelationTypeEnum::MANY_TO_MANY->value);
        if (!$this->fk) {
            $this->fk = $this->getFK($this->related);
        }
    }
}
