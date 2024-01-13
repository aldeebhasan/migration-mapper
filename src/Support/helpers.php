<?php

if (!function_exists('stub_path')) {

    function stub_path($path = ""): string
    {
        $basePath = __DIR__ . '/../../stubs';

        return $path ? $basePath . "/$path" : $basePath;

    }
}