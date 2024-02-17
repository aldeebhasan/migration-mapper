<?php

namespace Aldeebhasan\MigrationMapper\Logic\Models;

use Aldeebhasan\MigrationMapper\Attributes\Columns\Column;
use Aldeebhasan\MigrationMapper\Traits\Makable;

class ConfigHandler
{
    use Makable;

    private ?array $config = null;

    public function getConfig(): array
    {
        return $this->config ?? [];
    }

    public function setConfig(array $config): self
    {
        $this->config = $config;

        return $this;
    }

    /**
     * @param array<Column> $rawConfig
     * @return $this
     */
    public function parse(array $rawConfig): self
    {
        $this->config = [];
        foreach ($rawConfig as $column) {
            $this->config[$column->name] = $this->handleSingleRawConfig($column);
        }

        return $this;
    }

    private function handleSingleRawConfig(Column $colConfig): array
    {
        $configurations = $colConfig->getConfigurations();

        return [
            'type' => $colConfig->getType()->value,
            'properties' => $colConfig->getProperties(),
            'configurations' => array_map(
                fn ($configuration) => ['type' => $configuration, 'status' => 'create'],
                $configurations
            ),
            'status' => 'create',
        ];
    }

    public function diff(array $old): array
    {
        $config = [];
        foreach ($this->config as $key => $newConfig) {
            $oldConfig = $old[$key] ?? null;

            if (! $oldConfig) { // to add new column
                $config[$key] = $newConfig;
            } elseif (  // to update old column
                $oldConfig['type'] != $newConfig['type'] ||
                ! empty(array_diff_all($oldConfig['properties'], $newConfig['properties'])) ||
                ! empty(array_diff_all(
                    array_column($oldConfig['configurations'], 'type'),
                    array_column($newConfig['configurations'], 'type')
                ))
            ) {
                $newConfig['status'] = 'update';
                $configurations = $this->configurationDiff(
                    array_column($newConfig['configurations'], 'type'),
                    array_column($oldConfig['configurations'], 'type'),
                );
                $newConfig['configurations'] = $configurations;
                $newConfig['old_properties'] = $oldConfig['properties'];
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

    private function configurationDiff(array $current, array $old): array
    {
        $result = [];
        foreach (array_diff($current, $old) as $single) {
            $result[] = ['type' => $single, 'status' => 'create'];
        }
        foreach (array_diff($old, $current) as $single) {
            $result[] = ['type' => $single, 'status' => 'delete'];
        }

        return $result;
    }
}
