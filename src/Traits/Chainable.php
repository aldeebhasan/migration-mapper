<?php

namespace Aldeebhasan\MigrationMapper\Traits;

use Aldeebhasan\MigrationMapper\Logic\Blueprint\BlueprintIU;

trait Chainable
{
    /**
     * @var BlueprintIU[]
     */
    public function generate(): string
    {
        $subContent = '';
        foreach ($this->chains as $chain) {
            $subContent .= $chain->generate();
        }
        $content = $this->toString();
        $content = str_replace('{ content }', $subContent, $content);

        return $content;
    }
}
