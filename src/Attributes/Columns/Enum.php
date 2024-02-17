<?php

namespace Aldeebhasan\MigrationMapper\Attributes\Columns;

use Aldeebhasan\MigrationMapper\Enums\ColumnTypeEnum;

#[\Attribute(\Attribute::TARGET_PARAMETER)]
class Enum extends Column
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::ENUM;

    public function __construct(
        public string   $name,
        protected array $allowed,
        bool            $nullable = false,
        mixed           $default = null,
        bool            $index = false,
        bool            $unique = false,
        string          $comment = '',
    )
    {
        return parent::__construct($name, $nullable, $default, $index, $unique, $comment);
    }

    public function getProperties(): array
    {
        return [
            $this->allowed,
        ];
    }
}
