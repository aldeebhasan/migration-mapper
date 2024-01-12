<?php

namespace Aldeebhasan\Emigrate;


use Aldeebhasan\Emigrate\Attributes\Migratable;
use Aldeebhasan\Emigrate\Traits\Makable;
use Illuminate\Support\Facades\File;

class EmigrateManager
{
    use  Makable;

    public function generateMigration(): void
    {
        $paths = config('emigrate.model_paths');

        foreach ($paths as $path) {
            $this->handlePath($path);
        }

    }

    public function regenerateMigration(): void
    {

    }


    private function handlePath(string $path): void
    {
        $files = scandir($path);
        foreach ($files as $file) {
            if ($file === '.' || $file === '..') {
                continue;
            }
            $filePath = join('/', [$path, $file]);
            if (is_dir($filePath)) {
                $this->handlePath($filePath);
            } elseif (is_file($filePath)) {
                $this->handlePathFiles($filePath);
            }
        }
    }

    private function handlePathFiles(string $path): void
    {
        $className = pathinfo($path, PATHINFO_FILENAME);
        $nameSpace = $this->getNamespaceFromFile($path);
        $className = "$nameSpace\\$className";
        $reflection = new \ReflectionClass($className);
        $attributes = $reflection->getAttributes(Migratable::class);
        foreach ($attributes as $attribute) {
            $this->handleModel($reflection, $attribute);
        }
    }

    private function handleModel(\ReflectionClass $reflection, \ReflectionAttribute $attribute): void
    {
        $filename = strtolower($reflection->getShortName());
        dump($filename);
        $columns = [];
        foreach ($attribute->getArguments() as $key => $value) {
            $configuration = explode("|", $value);
            $columns[$key] = $configuration;
        }
    }


    private function getNamespaceFromFile($file): string
    {
        $namespace = '';
        $fileContents = File::get($file);

        // Use regular expressions to extract the namespace from the file contents
        preg_match('/namespace\s+([^\s;]+)/', $fileContents, $matches);

        if (isset($matches[1])) {
            $namespace = $matches[1];
        }

        return $namespace;
    }

}