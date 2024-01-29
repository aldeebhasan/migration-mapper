<?php

namespace Aldeebhasan\Emigrate\Logic\Models;

use Aldeebhasan\Emigrate\Attributes\Migratable;
use Aldeebhasan\Emigrate\Attributes\Relations\ERelation;
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
        return $this->instance->getTable();
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
        $attributes = $this->reflection->getAttributes(Migratable::class);
        if (empty($attributes)) {
            return;
        }
        //handle the model attributes
        $arguments = $attributes[0]->getArguments();
        $this->config = ConfigHandler::make()->parse($arguments)->getConfig();
    }

    public function detectRelations(): void
    {
        $methods = [];

        foreach ($this->reflection->getMethods() as $method) {
            $attributes = $method->getAttributes(ERelation::class, \ReflectionAttribute::IS_INSTANCEOF);
            if (!empty($attributes)) {
                $methods[] = $attributes[0]->getArguments();
            }
        }
        dd($methods);
        if (empty($methods)) {
            return;
        }
    }
}
