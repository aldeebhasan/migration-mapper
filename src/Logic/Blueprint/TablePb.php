<?php

namespace Aldeebhasan\Emigrate\Logic\Blueprint;


class TablePb extends BaseBlueprint
{
    private string $name = '';
    private string $action = 'create';

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

    public function template(): string
    {
        $slot = self::$slot;
        $tabs = str_repeat(self::$tab, 2);
        return match ($this->action) {
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
            default => "",
        };
    }

    public function toString(): string
    {
        $subContent = '';
        foreach ($this->chains as $chain) {
            $subContent .= $chain->toString();
        }
        $content = $this->template();

        return str_replace(self::$slot, $subContent, $content);
    }
}