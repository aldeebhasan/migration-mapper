<?php

namespace Aldeebhasan\Emigrate\Logic\Blueprint;

use Aldeebhasan\Emigrate\Enums\ColumnTypeEnum;
use Aldeebhasan\Emigrate\Logic\Migration\ColumnFactory;
use Aldeebhasan\Emigrate\Logic\Migration\Columns\GeneralColumn;
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

    protected function reverseTemplate(?TablePb $last): string
    {
        $changeMethod = collect($this->chains)->first(fn (MethodPb $item) => $item->isChange());

        //we are updating or dropping
        if ($changeMethod || $this->column->is(ColumnTypeEnum::DROP_COLUMN)) {
            /** @var ColumnPb $lastChange */
            $lastChange = collect($last->chains)->first(fn (ColumnPb $item) => $item->equal($this));

            collect($lastChange->chains)
                ->filter(fn (MethodPb $item) => $item->isChange())
                //if last migration is create then add change method
                ->when(
                    $changeMethod, // we are updating
                    function (Collection $collect) use ($lastChange, $changeMethod) {
                        if ($collect->isEmpty()) {
                            $lastChange->chain($changeMethod);
                        }
                    }
                )
                ->when(
                    $this->column->is(ColumnTypeEnum::DROP_COLUMN), // we are dropping
                    function (Collection $collect) use ($lastChange, $changeMethod) {
                        if ($collect->isNotEmpty()) {
                            $lastChange->unChain($changeMethod, );
                        }
                    }
                );

            return $lastChange->template();
        }

        $tabs = str_repeat(self::$tab, 3);
        $column = ColumnFactory::make(ColumnTypeEnum::DROP_COLUMN->value)->dropColumn($this->column->name);
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
