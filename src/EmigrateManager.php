<?php

namespace Aldeebhasan\Emigrate;


use Aldeebhasan\Emigrate\Attributes\Migratable;
use Aldeebhasan\Emigrate\Logic\IO\StubIO;
use Aldeebhasan\Emigrate\Logic\Migration\MigrationManager;
use Aldeebhasan\Emigrate\Traits\Makable;
use Illuminate\Support\Facades\File;

class EmigrateManager
{
    use  Makable;

    private MigrationManager $migrationManager;
    private StubIO $stubManager;

    public function __construct()
    {
        $this->migrationManager = MigrationManager::make();
        $this->stubManager = StubIO::make();
    }

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
        $columns = [];
        foreach ($attribute->getArguments() as $key => $value) {
            //start with:  'decimal:10,2->nullable|default:empty'
            $columnData = explode("->", $value); // [ 'decimal:10,2','index|nullable']
            $typeData = explode(":", $columnData[0]); //['decimal','10,2']
            $typeProperties = explode(",", $typeData[1] ?? ''); //[10,2]

            $configuration = explode("|", $columnData[1] ?? ''); // ['nullable','default:empty']

            $columns[$key] = [
                'type' => $typeData[0],
                'properties' => $typeProperties,
                'configurations' => $configuration,
            ];
        }

        $tableName = str($filename)->plural()->toString();
        $baseTable = $this->migrationManager->makeTable($tableName);
        foreach ($columns as $name => $columnConfig) {
            $type = $columnConfig['type'];
            $properties = $columnConfig['properties'];
            $baseColumn = $this->migrationManager->makeColumn($type, $name, ...$properties);
            foreach ($columnConfig['configurations'] ?? [] as $config) {
                $propertyData = explode(":", $config);
                $baseMethod = $this->migrationManager->makeMethod($propertyData[0], $propertyData[1] ?? '');
                $baseColumn->chain($baseMethod);
            }
            $baseTable->chain($baseColumn);
        }

        $this->stubManager->read(stub_path("migration.generate.anonymous.stub"));
        $this->stubManager->prepare($baseTable->toString(), '');
        $this->stubManager->write(database_path("migrations/create_{$filename}_table.php"));

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