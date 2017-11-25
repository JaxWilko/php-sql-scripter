<?php

$mappings = [
    'Vendors'  => 'vendors',
    'Logger'   => 'vendors/Logger',
    'Database' => 'vendors/Database',
    'App'      => 'src'
];

define('APP_ROOT', __DIR__);

spl_autoload_register(function ($class) use ($mappings) {
    $file = explode('/', str_replace('\\', '/', $class) . '.php', 2);

    if (isset($mappings[$file[0]])) {
        $file[0] = $mappings[$file[0]];
    }

    $file = implode('/', $file);

    if (file_exists(APP_ROOT . '/' . $file)) {
        require_once APP_ROOT . '/' . $file;
    }
});