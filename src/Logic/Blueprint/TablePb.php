<?php

namespace Aldeebhasan\Emigrate\Logic\Blueprint;

class TablePb extends BaseBlueprint
{
    private string $name = '';

    private string $action = 'create';

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setAction(string $action): self
    {
        $this->action = $action;

        return $this;
    }

    public function isUpdate(): bool
    {
        return $this->action === 'update';
    }

    protected function template(): string
    {
        $slot = self::$slot;
        $tabs = str_repeat(self::$tab, 2);
        $content = match ($this->action) {
            'create' => <<<EOD
                        {$tabs}Schema::create('$this->name', function (Blueprint \$table) {
                        $slot
                        {$tabs}});
                        EOD,
            'update' => <<<EOD
                        {$tabs}Schema::table('$this->name', function (Blueprint \$table) {
                        $slot
                        {$tabs}});
                        EOD,
            'destroy' => <<<EOD
                         {$tabs}Schema::dropIfExists('$this->name');
                        EOD,
            default => '',
        };

        return $this->handleChain($content);
    }

    protected function reverseTemplate(?TablePb $last): string
    {
        $slot = self::$slot;
        $tabs = str_repeat(self::$tab, 2);
        $content = match ($this->action) {
            'create' => <<<EOD
                         {$tabs}Schema::dropIfExists('$this->name');
                        EOD,
            'update' => <<<EOD
                        {$tabs}Schema::table('$this->name', function (Blueprint \$table) {
                        $slot
                        {$tabs}});
                        EOD,
            'destroy' => <<<EOD
                        {$tabs}Schema::create('$this->name', function (Blueprint \$table) {
                        $slot
                        {$tabs}});
                        EOD,
            default => '',
        };

        return $this->handleChain($content, true, $last);
    }

    private function handleChain(string $content, bool $reverse = false, ?TablePb $last = null): string
    {
        $subContent = PHP_EOL;
        foreach ($this->chains as $chain) {
            $subContent .= $reverse ? $chain->toStringReversed($last) : $chain->toString();
        }

        return str_replace(self::$slot, $subContent, $content);
    }

}
