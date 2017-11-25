<?php

namespace Logger;

use Database\DB;

class Log
{
    private static $logFile = '/tmp/logger.log';
    private static $debug = false;

    public static function register($logFile, $debug = false)
    {
        self::setDebug($debug);
        self::setLogFile($logFile);
    }

    public static function setLogFile($file)
    {
        self::$logFile = $file;
    }

    public static function setDebug($debug)
    {
        self::$debug = $debug;
    }

    public static function write($message, $level = false, $details = '')
    {
        if (self::$debug) {
            echo date('[Y-m-d H:i:s]') . ' ' . $message . PHP_EOL;
        }

        return error_log(date('[Y-m-d H:i:s]') . ' ' . $message . PHP_EOL, 3, self::$logFile);
    }
}
