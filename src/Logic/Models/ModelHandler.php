<?php

namespace Aldeebhasan\Emigrate\Logic\Models;

use Aldeebhasan\Emigrate\Attributes\Migratable;
use Aldeebhasan\Emigrate\Traits\Makable;

/**
 * @method static ModelHandler make(string $path)
 */
class ModelHandler
{
    use Makable;

    private \ReflectionClass $reflection;

    private ?array $config = null;

    public function __construct(private readonly string $path)
    {
        $className = pathinfo($path, PATHINFO_FILENAME);
        $nameSpace = detect_namespace($path);
        $className = "$nameSpace\\$className";
        $this->reflection = new \ReflectionClass($className);
    }

    public function getTableName(): string
    {
        $filename = strtolower($this->reflection->getShortName());

        return str($filename)->plural()->toString();
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

    }
}
