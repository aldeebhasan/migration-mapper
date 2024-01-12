<?php

namespace Aldeebhasan\Emigrate\Logic\IO;

use Aldeebhasan\Emigrate\Traits\Makable;
use Illuminate\Support\Facades\File;

class StubIO
{
    use Makable;

    private string $content = '';


    public function getContent(): string
    {
        return $this->content;
    }

    public function read(string $path): self
    {
        $this->content = File::get($path);
        return $this;
    }


    public function prepare(
        string $upContent,
        string $downContent,
        string $use = "",
    ): self
    {
        $replace = [
            '{{ use }}' => $use,
            '{{ up }}' => $upContent,
            '{{ down }}' => $downContent,
        ];
        $this->content = str_replace(array_keys($replace), $replace, $this->content);

        return $this;
    }

    public function write(string $path): self
    {
        File::put($path, $this->content);
        return $this;
    }

}