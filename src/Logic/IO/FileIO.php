<?php

namespace Aldeebhasan\MigrationMapper\Logic\IO;

use Aldeebhasan\MigrationMapper\Traits\Makable;
use Illuminate\Support\Facades\File;

abstract class FileIO
{
    use Makable;

    protected string $content = '';

    public function getContent(): string
    {
        return $this->content;
    }

    public function read(string $path): self
    {
        $this->content = File::get($path);

        return $this;
    }

    public function write(string $path): self
    {
        File::put($path, $this->content);

        return $this;
    }

    abstract public function prepare(string ...$args): self;
}
