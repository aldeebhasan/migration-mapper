<?php

namespace Aldeebhasan\Emigrate\Attributes\Relations;

use Aldeebhasan\Emigrate\Enums\RelationTypeEnum;

#[\Attribute(\Attribute::TARGET_FUNCTION | \Attribute::TARGET_METHOD)]
class ManyToMany extends ERelation
{
    public function __construct(
        public string $related,
        public string $table,
        public ?string $foreignKey = null,
        public ?string $localKey = null
    )
    {
        parent::__construct(RelationTypeEnum::MANY_TO_MANY->value);
        if (! $this->foreignKey) {
            $this->foreignKey = $this->getFK($this->related);
        }
    }
}
