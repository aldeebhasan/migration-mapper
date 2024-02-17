<?php

namespace Aldeebhasan\MigrationMapper\Attributes\Relations;

use Aldeebhasan\MigrationMapper\Enums\RelationTypeEnum;

#[\Attribute(\Attribute::TARGET_FUNCTION | \Attribute::TARGET_METHOD)]
class ManyToMany extends ERelation
{
    public function __construct(
        public string $related,
        public string $table,
        public ?string $foreignKey = null,
        public ?string $localKey = null,
        public ?string $targetForeignKey = null,
        public ?string $targetLocalKey = null,
    )
    {
        parent::__construct(RelationTypeEnum::MANY_TO_MANY->value);
        if (! $this->targetForeignKey) {
            $this->targetLocalKey = app($this->related)->getKeyName();
            $this->targetForeignKey = app($this->related)->getForeignKey();
        }
    }
}
