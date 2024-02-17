<?php

namespace Aldeebhasan\MigrationMapper\Logic\IO;

use Illuminate\Support\Facades\File;

/**
 * @method static TrackO make()
 * @method static TrackO prepare(string $content)
 */
class TrackO extends FileIO
{
    public function read(string $path): FileIO
    {
        if (! File::exists($path)) {
            $dir = preg_split("/\//", $path, -1, PREG_SPLIT_NO_EMPTY);
            $dir = implode('/', array_slice($dir, 0, count($dir) - 1));
            $dir = "/$dir";
            if (! File::exists($dir)) {
                File::makeDirectory($dir);
            }
            File::put($path, '');
        }

        return parent::read($path);
    }

    public function prepare(string ...$args): self
    {
        $content = $args[0] ?? '';
        if (! empty($content)) {
            $fileContent = json_decode($this->content, true);
            $fileContent[] = $content;
            $this->content = json_encode($fileContent);
        }

        return $this;
    }

    public function lastLog(): ?array
    {
        $fileContent = json_decode($this->content, true);
        $lastLog = null;
        if (! empty($fileContent)) {
            $lastLog = last($fileContent);
            $lastLog = json_decode($lastLog, true);
        }

        return $lastLog;
    }

    public function excludeLastLog(): bool
    {
        $fileContent = json_decode($this->content, true);

        if (! empty($fileContent)) {
            $newContent = array_slice($fileContent, 0, -1);
            $this->content = json_encode($newContent);

            return true;
        }

        return false;
    }
}
