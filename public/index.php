<?php

declare (strict_types = 1);

$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;

define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
define('FILES_PATH', $root . 'transaction_files' . DIRECTORY_SEPARATOR);
define('VIEWS_PATH', $root . 'views' . DIRECTORY_SEPARATOR);

/* YOUR CODE (Instructions in README.md) */

require APP_PATH . 'App.php';
require APP_PATH . 'format.php';

$files = getTransactionFiles(FILES_PATH);

$transactions = [];
foreach ($files as $file) {
    $transactions = getTransactions($file, 'readTransaction');
}

$totals = calTotals($transactions);
// print_r($totals);
require VIEWS_PATH . 'transactions.php';
