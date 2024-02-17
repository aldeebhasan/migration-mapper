<?php

namespace Aldeebhasan\Emigrate\Attributes\Columns;

use Aldeebhasan\Emigrate\Attributes\EAttribute;
use Aldeebhasan\Emigrate\Enums\ColumnTypeEnum;

/**
 * @method static Column id(string $name = 'id')
 */
#[\Attribute(\Attribute::TARGET_PARAMETER)]
abstract class Column extends EAttribute
{
    protected ColumnTypeEnum $type;

    public function __construct(
        public string $name,
        protected bool $nullable = false,
        protected mixed $default = null,
        protected bool $index = false,
        protected bool $unique = false,
        protected string $comment = '',
    )
    {
    }

    public function getType(): ColumnTypeEnum
    {
        return $this->type;
    }

    public function getProperties(): array
    {
        return [];
    }

    public function getConfigurations(): array
    {
        $config = [];
        if (property_exists($this, 'nullable') && $this->nullable) {
            $config[] = 'nullable';
        }
        if (property_exists($this, 'default') && ! is_null($this->default)) {
            $config[] = "default:$this->default";
        }
        if (property_exists($this, 'unsigned') && $this->unsigned) {
            $config[] = 'unsigned';
        }
        if (property_exists($this, 'index') && $this->index) {
            $config[] = 'index';
        }
        if (property_exists($this, 'unique') && $this->unique) {
            $config[] = 'unique';
        }
        if (property_exists($this, 'autoIncrement') && $this->autoIncrement) {
            $config[] = 'autoIncrement';
        }
        if (property_exists($this, 'comment') && $this->comment) {
            $config[] = "comment:$this->comment";
        }

        return $config;
    }
}
