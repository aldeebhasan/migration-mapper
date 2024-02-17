<?php

namespace Aldeebhasan\MigrationMapper\Attributes\Relations;

use Aldeebhasan\MigrationMapper\Enums\RelationTypeEnum;

#[\Attribute(\Attribute::TARGET_FUNCTION | \Attribute::TARGET_METHOD)]
class OneToOne extends ERelation
{
    public function __construct(public string $related, public ?string $foreignKey = null, public ?string $localKey = null)
    {
        parent::__construct(RelationTypeEnum::ONE_TO_ONE->value);
        if (! $this->foreignKey) {
            $this->foreignKey = app($this->related)->getForeignKey();
        }
    }
}
