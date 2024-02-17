<?php

namespace Aldeebhasan\MigrationMapper\Logic\Migration\Columns;

use Aldeebhasan\MigrationMapper\Enums\ColumnTypeEnum;

class DecimalColumn extends GeneralColumn
{
    protected $defaultTotal = 8;

    protected $defaultPlaces = 2;

    protected ColumnTypeEnum $type = ColumnTypeEnum::DECIMAL;

    public function __construct(public string $name, public int $total = 8, public int $places = 2)
    {
    }

    public function toString(): string
    {
        $method = $this->type->value;
        $params = "'$this->name'";
        if ($this->total !== $this->defaultTotal) {
            if ($this->places !== $this->defaultPlaces) {
                $params = "'$this->name', $this->total, $this->places";
            } else {
                $params = "'$this->name', $this->total";
            }
        }

        return "$method($params)";
    }
}
