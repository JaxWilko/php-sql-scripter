<?php

namespace App\Helper;

class Cli
{
    public static function ask($message)
    {
        echo date('[Y-m-d H:i:s]') . ' ' . $message . PHP_EOL . '> ';
        $handle = fopen ("php://stdin","r");
        $line = fgets($handle);
        fclose($handle);
        return str_replace(PHP_EOL, '', $line);
    }

    public static function say($message)
    {
        echo date('[Y-m-d H:i:s]') . ' ' . $message . PHP_EOL;
        return true;
    }
}