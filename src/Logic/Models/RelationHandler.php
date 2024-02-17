<?php

namespace Aldeebhasan\MigrationMapper\Logic\Models;

use Aldeebhasan\MigrationMapper\Attributes\Relations\ERelation;
use Aldeebhasan\MigrationMapper\Attributes\Relations\ManyToMany;
use Aldeebhasan\MigrationMapper\Attributes\Relations\ManyToOne;
use Aldeebhasan\MigrationMapper\Enums\ColumnTypeEnum;
use Aldeebhasan\MigrationMapper\Traits\Makable;
use Illuminate\Database\Eloquent\Model;

class RelationHandler
{
    use Makable;

    private ?array $config = null;

    private ?array $tableConfig = null;

    public function __construct(private ?Model $model = null)
    {
    }

    public function getConfig(): array
    {
        return $this->config ?? [];
    }

    public function getTableConfig(): array
    {
        return $this->tableConfig ?? [];
    }

    public function setConfig(array $config): self
    {
        $this->config = $config;

        return $this;
    }

    public function parse(ERelation $instance): self
    {
        $this->config = [];
        $this->tableConfig = [];
        if ($instance instanceof ManyToOne) {
            $this->config[$instance->foreignKey] = [
                'type' => ColumnTypeEnum::FOREIGN->value,
                'table' => $this->model->getTable(),
                'reference' => $instance->ownerKey ?: $this->model->getKeyName(),
                'status' => 'create',
            ];
        } elseif ($instance instanceof ManyToMany) {
            $foreignConfig = [
                'type' => ColumnTypeEnum::BIG_INTEGER->value,
                'properties' => [],
                'configurations' => [
                    [
                        'type' => 'index',
                        'status' => 'create',
                    ],
                ],
                'status' => 'create',
            ];
            $tableConfigs = [
                'columns' => [
                    'id' => [
                        'type' => ColumnTypeEnum::ID->value,
                        'properties' => [],
                        'configurations' => [],
                        'status' => 'create',
                    ],
                    $instance->foreignKey ?: $this->model->getForeignKey() => $foreignConfig,
                    $instance->targetForeignKey => $foreignConfig,
                ],
                'relations' => [
                    $instance->foreignKey ?: $this->model->getForeignKey() => [
                        'type' => ColumnTypeEnum::FOREIGN->value,
                        'table' => $this->model->getTable(),
                        'reference' => $instance->localKey ?: $this->model->getKeyName(),
                        'status' => 'create',
                    ],
                    $instance->targetForeignKey => [
                        'type' => ColumnTypeEnum::FOREIGN->value,
                        'table' => app($instance->related)->getTable(),
                        'reference' => $instance->targetLocalKey ?: app($instance->related)->getKeyName(),
                        'status' => 'create',
                    ],
                ],
            ];
            $this->tableConfig[$instance->table] = $tableConfigs;
        }

        return $this;
    }

    public function diff(array $old): array
    {
        $config = [];
        foreach ($this->config as $key => $newConfig) {
            $oldConfig = $old[$key] ?? null;

            if (! $oldConfig) { // to add new column
                $config[$key] = $newConfig;
            } elseif (! empty(array_diff_all($oldConfig, $newConfig))) {
                $newConfig['status'] = 'update';
                $config[$key] = $newConfig;
            }
        }

        // to delete old column
        foreach (array_diff(array_keys($old), array_keys($this->config)) as $dropKey) {
            $dropConfig = $old[$dropKey];
            $dropConfig['status'] = 'delete';
            $config[$dropKey] = $dropConfig;
        }

        return $config;
    }
}
