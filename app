#!/usr/bin/env php
<?php

require __DIR__ . '/autoload.php';
require __DIR__ . '/config.php';

$options = getopt('vhtn:r:', ['verbose', 'help', 'test', 'new:', 'run:']);

if (isset($options['h']) || isset($options['help'])) {
    echo '-h, --help'       . "\t\t" . 'to see this message' . PHP_EOL;
    echo '-n, --new [name]' . "\t"   . 'to create a new transaction template' . PHP_EOL;
    echo '-r, --run [name]' . "\t"   . 'to select a file' . PHP_EOL;
    echo '-v, --verbose'    . "\t\t" . 'to display logging' . PHP_EOL;
    die();
}

$debug = (isset($options['v']) || isset($options['verbose']));

Logger\Log::register(__DIR__ . '/log/' . date('Ymd') . '.log', $debug);

if (isset($options['n']) || isset($options['new'])) {
    $file = __DIR__ . '/transactions/' . (isset($options['n']) ? $options['n'] : (isset($options['new']) ? $options['new'] : date('YmdHis'))) . '.php';
    if (file_exists($file)) {
        echo 'File exists, exiting...' . PHP_EOL;
        die();
    }

    file_put_contents($file, file_get_contents(__DIR__ . '/src/templates/transaction.php'));
    Logger\Log::write('Transaction created: ' . $file);
    echo 'Transaction created: ' . $file . PHP_EOL;
    die();
}

if (isset($options['r']) || isset($options['run'])) {
    $file = __DIR__ . '/transactions/' . (isset($options['r']) ? $options['r'] : (isset($options['run']) ? $options['run'] : date('YmdHis'))) . '.php';
    if (!file_exists($file)) {
        echo 'File does not exists, exiting...' . PHP_EOL;
        die();
    }

    Logger\Log::write('Running: ' . $file);
    require $file;
    die();
}
