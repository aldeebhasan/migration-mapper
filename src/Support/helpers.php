<?php

use Illuminate\Support\Facades\File;

if (! function_exists('stub_path')) {
    function stub_path(string $path = ''): string
    {
        $basePath = __DIR__.'/../../stubs';

        return $path ? $basePath."/$path" : $basePath;

    }
}

if (! function_exists('str_purify')) {
    function str_purify(string $str): string
    {
        return str_replace(' ', '', $str);

    }
}
if (! function_exists('detect_namespace')) {
    function detect_namespace($file): string
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
