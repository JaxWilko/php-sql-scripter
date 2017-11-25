<?php

namespace App\Engine;

use App\Engine\Results;
use App\Engine\Errors;
use App\Helper\Cli;
use Database\DB;
use Logger\Log;

class Transaction
{
    private $statements = [];
    private $results;
    private $errors;

    public function __construct()
    {
        $this->results = new Results();
        $this->errors = new Errors();
    }

    public function add($stmt, $index = false)
    {
        if ($index) {
            $this->statements[$index] = $stmt;
        } else {
            $this->statements[] = $stmt;
        }

        return $this;
    }

    public function review()
    {
        if (empty($this->statements)) {
            $this->errors->put('No statements provided');
            return false;
        }

        foreach ($this->statements as $statement) {
            echo $statement . PHP_EOL;
            if (Cli::ask('Confirm statement (y/n)') !== 'y') {
                return false;
            }
        }

        return true;
    }

    public function commit()
    {
        foreach ($this->statements as $index => $statement) {

            try {
                $pdoStmt = DB::prepare('#DataMigrator' . PHP_EOL . $statement);
                $pdoStmt->execute();

                if ($pdoStmt->errorInfo()[0] != '00000') {
                    return $this->errorHandler($index, $statement, $pdoStmt->errorInfo());
                }

            } catch (\Exception $e){
                return $this->errorHandler($index, $statement, $e->getMessage());
            }

            $this->results->put($pdoStmt->fetchAll(), $index);
        }

        return true;
    }

    private function errorHandler($index, $statement, $error)
    {
        $this->errors->put($error, $index);
        Log::write($statement . PHP_EOL . print_r($error, true));
        return false;
    }

    public function result()
    {
        return $this->results;
    }

    public function error()
    {
        return $this->errors;
    }
}