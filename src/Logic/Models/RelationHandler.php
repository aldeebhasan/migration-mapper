<?php

namespace Aldeebhasan\Emigrate\Logic\Models;

use Aldeebhasan\Emigrate\Traits\Makable;

class RelationHandler
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

    public function parse(array $rawConfig): self
    {
        $this->config = [];
        foreach ($rawConfig as $key => $value) {
            $key = str_purify($key);
            $this->config[$key] = $this->handleSingleRawConfig($value);
        }

        return $this;
    }

    private function handleSingleRawConfig(string $colConfig): array
    {

    }

    public function diff(array $old): array
    {
        $config = [];

        return $config;
    }
}
