<?php

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
