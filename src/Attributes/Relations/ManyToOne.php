<?php

namespace Aldeebhasan\MigrationMapper\Attributes\Relations;

use Aldeebhasan\MigrationMapper\Enums\RelationTypeEnum;

#[\Attribute(\Attribute::TARGET_FUNCTION | \Attribute::TARGET_METHOD)]
class ManyToOne extends ERelation
{
    public function __construct(public string $related, public ?string $foreignKey = null, public ?string $ownerKey = null)
    {
        parent::__construct(RelationTypeEnum::MANY_TO_ONE->value);
        if (! $this->foreignKey) {
            $this->foreignKey = app($this->related)->getForeignKey();
        }
    }
}
