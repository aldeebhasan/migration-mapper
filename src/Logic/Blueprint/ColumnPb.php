<?php

namespace Aldeebhasan\Emigrate\Logic\Blueprint;


use Aldeebhasan\Emigrate\Enums\ColumnTypeEnum;
use Aldeebhasan\Emigrate\Logic\Migration\Columns\GeneralColumn;

class ColumnPb extends BaseBlueprint
{

    private string $name = '';
    private GeneralColumn $column;

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function setColumn(GeneralColumn $column): self
    {
        $this->column = $column;
        return $this;
    }

    public function template(): string
    {
        return "\$table->" . $this->column->toString();
    }

    public function toString(): string
    {
        $content = '';
        foreach ($this->chains as $chain) {
            $content .= $this->template() . $chain->toString() . PHP_EOL;
        }
        return $content;
    }
}