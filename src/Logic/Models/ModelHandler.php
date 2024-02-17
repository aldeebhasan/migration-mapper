<?php

namespace Aldeebhasan\Emigrate\Logic\Models;

use Aldeebhasan\Emigrate\Attributes\Relations\ERelation;
use Aldeebhasan\Emigrate\Attributes\Table;
use Aldeebhasan\Emigrate\Traits\Makable;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static ModelHandler make(string $path)
 */
class ModelHandler
{
    use Makable;

    private \ReflectionClass $reflection;

    private Model $instance;

    private ?array $config = null;

    public function __construct(private readonly string $path)
    {
        $className = pathinfo($path, PATHINFO_FILENAME);
        $nameSpace = detect_namespace($path);
        $className = "$nameSpace\\$className";
        $this->reflection = new \ReflectionClass($className);
        $this->instance = $this->reflection->newInstance();
    }

    public function getTableName(): string
    {
        $tableName = $this->instance->getTable();
        $attributes = $this->reflection->getAttributes(Table::class);
        if (! empty($attributes)) {
            $table = $attributes[0]->newInstance();
            if ($table->name) {
                $tableName = $table->name;
            }
        }

        return $tableName;
    }

    public function getConfig(): array
    {
        return $this->config ?? [];
    }

    public function handle(): self
    {
        $this->detectColumns();
        $this->detectRelations();

        return $this;
    }

    public function detectColumns(): void
    {
        $attributes = $this->reflection->getAttributes(Table::class);
        if (empty($attributes)) {
            return;
        }
        //handle the model attributes
        $arguments = $attributes[0]->getArguments();
        $this->config['columns'] = ConfigHandler::make()->parse($arguments['columns'] ?? [])->getConfig();
    }

    public function detectRelations(): void
    {
        $relations = [];
        $tables = [];
        $handler = RelationHandler::make($this->instance);
        foreach ($this->reflection->getMethods() as $method) {
            $attributes = $method->getAttributes(ERelation::class, \ReflectionAttribute::IS_INSTANCEOF);
            if (! empty($attributes)) {
                $instance = $attributes[0]->newInstance();
                $handler = $handler->parse($instance);
                $relations += $handler->getConfig();
                $tables += $handler->getTableConfig();
            }
        }

        $this->config['relations'] = $relations;
        $this->config['tables'] = $tables;
    }
}
