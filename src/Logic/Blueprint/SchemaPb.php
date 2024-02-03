<?php

namespace Aldeebhasan\Emigrate\Logic\Blueprint;

class SchemaPb extends BaseBlueprint
{
    public function getName(): string
    {
        return '';
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    protected function template(): string
    {

        return $this->handleChain('');
    }

    protected function reverseTemplate(?BaseBlueprint $last): string
    {
        return $this->handleChain('', true, $last);
    }

    private function handleChain(string $content, bool $reverse = false, ?BaseBlueprint $last = null): string
    {
        $subContent = '';
        foreach ($this->chains as $chain) {
            if ($reverse) {
                $last = collect($last->chains)->first(fn (BlueprintIU $item) => $item->equal($chain));
                $subContent .= $chain->toStringReversed($last);
            } else {
                $subContent .= $chain->toString();
            }
            $subContent .= PHP_EOL;
        }

        return str_replace(self::$slot, $subContent, $content);
    }
}
