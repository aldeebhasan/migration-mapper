<?php

namespace Aldeebhasan\Emigrate\Logic\IO;

/**
 * @method static StubIO make()
 * @method static StubIO prepare(string $upContent, string $downContent, string $use = "")
 */
class StubIO extends FileIO
{
    public function prepare(string ...$args): self
    {
        $replace = [
            '{{ up }}' => $args[0] ?? '',
            '{{ down }}' => $args[1] ?? '',
            '{{ use }}' => $args[2] ?? '',
        ];
        $this->content = str_replace(array_keys($replace), $replace, $this->content);

        return $this;
    }
}
