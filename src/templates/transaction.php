<?php

/**
 * Instantiate a new transaction
 */

$app = new App\Engine\Transaction();

/**
 * Add some queries
 */

$app->add("SHOW TABLES");
$app->add("SHOW TABLES", 'key');

/**
 * Review and commit
 */

if (!$app->review()) {
    die('Exiting...' . PHP_EOL);
}

$app->commit();

/**
 * View results
 */

$app->result()->first();
$app->result()->get('key');

/**
 * View errors
 */

$app->error()->first();
$app->error()->get('key');
