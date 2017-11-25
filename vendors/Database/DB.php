<?php

namespace Database;

use PDO;

class DB
{
    private static $pdo;

    private function __construct() {}

    private function __clone() {}

    private static function getInstance()
    {
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return $pdo;
    }

    final public static function __callStatic($chrMethod, $arrArguments)
    {
        if (!self::$pdo) self::$pdo = self::getInstance();
        return call_user_func_array(array(self::$pdo, $chrMethod), $arrArguments);
    }
}
