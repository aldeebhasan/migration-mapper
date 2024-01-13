<?php

namespace Aldeebhasan\Emigrate\Logic\Blueprint;


use Aldeebhasan\Emigrate\Logic\Migration\Columns\GeneralColumn;

class ColumnPb extends BaseBlueprint
{

    private GeneralColumn $column;


    public function setColumn(GeneralColumn $column): self
    {
        $this->column = $column;
        return $this;
    }

    public function template(): string
    {
        $tabs = str_repeat(self::$tab,3);
        return "{$tabs}\$table->" . $this->column->toString();
    }

    public function toString(): string
    {
        $content = $this->template();
        foreach ($this->chains as $chain) {
            $content .= $chain->toString();
        }
        $content .= ';' . PHP_EOL;
        return $content;
    }
}