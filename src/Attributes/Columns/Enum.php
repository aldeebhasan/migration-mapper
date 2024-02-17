<?php

namespace Aldeebhasan\Emigrate\Attributes\Columns;

use Aldeebhasan\Emigrate\Enums\ColumnTypeEnum;

#[\Attribute(\Attribute::TARGET_PARAMETER)]
class Enum extends Column
{
    protected ColumnTypeEnum $type = ColumnTypeEnum::ENUM;

    public function __construct(
        public string $name,
        protected array $allowed,
        protected bool $nullable = false,
        protected mixed $default = null,
        protected bool $index = false,
        protected bool $unique = false,
        protected string $comment = '',
    )
    {
//        parent::__construct($name);
    }

    public function getProperties(): array
    {
        return [
            $this->allowed,
        ];
    }
}
