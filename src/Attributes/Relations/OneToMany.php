<?php

namespace Aldeebhasan\MigrationMapper\Attributes\Relations;

use Aldeebhasan\MigrationMapper\Enums\RelationTypeEnum;

#[\Attribute(\Attribute::TARGET_FUNCTION | \Attribute::TARGET_METHOD)]
class OneToMany extends ERelation
{
    public function __construct(public string $related, public ?string $foreignKey = null, public ?string $localKey = null)
    {
        parent::__construct(RelationTypeEnum::ONE_TO_MANY->value);
        if (! $this->foreignKey) {
            $this->foreignKey = app($this->related)->getForeignKey();
        }
    }
}
