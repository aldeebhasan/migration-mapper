<?php

namespace Aldeebhasan\MigrationMapper\Logic\Blueprint;

use Aldeebhasan\MigrationMapper\Enums\ColumnTypeEnum;
use Aldeebhasan\MigrationMapper\Logic\Migration\ColumnFactory;
use Aldeebhasan\MigrationMapper\Logic\Migration\Columns\GeneralColumn;
use Illuminate\Support\Collection;

class ColumnPb extends BaseBlueprint
{
    private GeneralColumn $column;

    public function setColumn(GeneralColumn $column): self
    {
        $this->column = $column;

        return $this;
    }

    public function getName(): string
    {
        return $this->column->name;
    }

    public function template(): string
    {
        $tabs = str_repeat(self::$tab, 3);
        $content = "{$tabs}\$table->".$this->column->toString();

        return $this->handleChain($content);
    }

    protected function reverseTemplate(?BaseBlueprint $last): string
    {
        $changeMethod = collect($this->chains)->first(fn (MethodPb $item) => $item->isChange());

        //we are updating or dropping
        if ($changeMethod
            || $this->column->is(ColumnTypeEnum::DROP_COLUMN)
            || $this->column->is(ColumnTypeEnum::DROP_FOREIGN)
        ) {
            collect($last->chains)
                ->filter(fn (MethodPb $item) => $item->isChange())
                //if last migration is create then add change method
                ->when(
                    $changeMethod, // we are updating
                    function (Collection $collect) use ($last, $changeMethod) {
                        if ($collect->isEmpty()) {
                            $last->chain($changeMethod);
                        }
                    }
                )
                ->when(
                    $this->column->is(ColumnTypeEnum::DROP_COLUMN), // we are dropping column
                    function (Collection $collect) use ($last, $changeMethod) {
                        if ($collect->isNotEmpty()) {
                            $last->unChain($changeMethod);
                        }
                    }
                )->when(
                    $this->column->is(ColumnTypeEnum::DROP_FOREIGN), // we are dropping foreign
                    function (Collection $collect) use ($last, $changeMethod) {
                        if ($collect->isNotEmpty()) {
                            $last->unChain($changeMethod);
                        }
                    }
                );

            return $last->template();
        }

        $tabs = str_repeat(self::$tab, 3);
        if ($this->column->is(ColumnTypeEnum::FOREIGN)) {
            $column = ColumnFactory::make()->dropForeign($this->column->name);
        } else {
            $column = ColumnFactory::make()->dropColumn($this->column->name);
        }
        $content = "{$tabs}\$table->".$column->toString().';'.PHP_EOL;

        return $content;

    }

    private function handleChain(string $content): string
    {
        foreach ($this->chains as $chain) {
            $content .= $chain->toString();
        }
        $content .= ';'.PHP_EOL;

        return $content;
    }
}
