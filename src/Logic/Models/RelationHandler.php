<?php

namespace Aldeebhasan\Emigrate\Logic\Models;

use Aldeebhasan\Emigrate\Attributes\Relations\ERelation;
use Aldeebhasan\Emigrate\Attributes\Relations\ManyToMany;
use Aldeebhasan\Emigrate\Attributes\Relations\ManyToOne;
use Aldeebhasan\Emigrate\Enums\ColumnTypeEnum;
use Aldeebhasan\Emigrate\Traits\Makable;
use Illuminate\Database\Eloquent\Model;

class RelationHandler
{
    use Makable;

    private ?array $config = null;

    public function __construct(private ?Model $model = null)
    {
    }

    public function getConfig(): array
    {
        return $this->config ?? [];
    }

    public function setConfig(array $config): self
    {
        $this->config = $config;

        return $this;
    }

    public function parse(ERelation $instance): self
    {
        $this->config = [];
        if ($instance instanceof ManyToOne) {
            $this->config[$instance->foreignKey] = [
                'type' => ColumnTypeEnum::FOREIGN->value,
                'table' => $this->model->getTable(),
                'reference' => $instance->ownerKey,
                'status' => 'create',
            ];
        } elseif ($instance instanceof ManyToMany) {
//            $this->config[] = [
//                'column' => $instance->foreignKey,
//                'table' => $this->model->getTable(),
//                'reference' => $instance->ownerKey
//            ];
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
            $dropConfig['type'] = ColumnTypeEnum::DROP_FOREIGN->value;
            $dropConfig['status'] = 'delete';
            $config[$dropKey] = $dropConfig;
        }

        return $config;
    }
}
