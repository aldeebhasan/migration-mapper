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
        return match ($this->action) {
            'create' => <<<EOD
                        Schema::create('$this->name', function (Blueprint \$table) {
                           $slot
                        });
                        EOD,
            'update' => <<<EOD
                        Schema::table('$this->name', function (Blueprint \$table) {
                           $slot
                        });
                        EOD,
            'destroy' => <<<EOD
                         Schema::dropIfExists('$this->name');
                        EOD,
            default => "",
        };
    }

    public function toString(): string
    {
        return $this->template();
    }
}