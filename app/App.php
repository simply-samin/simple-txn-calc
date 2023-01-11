<?php

declare (strict_types = 1);

// Your Code
function getTransactionFiles(string $dirPath): array
{
    $files = [];

    foreach (scandir($dirPath) as $file) {
        if (is_dir($file)) {
            continue;
        }

        $files[] = $dirPath . $file;
    }

    return $files;
}

function getTransactions(string $filename, ?callable $transactionHandler = null): array
{
    if (!file_exists($filename)) {
        @trigger_error('File' . $filename . 'does not exist.', E_USER_ERROR);
    }

    $file = fopen($filename, 'r');

    fgetcsv($file);
    $transactions = [];

    while (($transaction = fgetcsv($file)) !== false) {
        if ($transactionHandler == !null) {
            $transactions[] = $transactionHandler($transaction);
        }

    }
    return $transactions;
}

function readTransaction(array $transactionRow): array
{

    [$date, $checkNumber, $desc, $amount] = $transactionRow;

    $amount = (float) str_replace(['$', ','], '', $amount);

    return [
        'date' => $date,
        'checkNumber' => $checkNumber,
        'desc' => $desc,
        'amount' => $amount,

    ];
}

function calTotals(array $transactions): array
{
    $totals = ['netTotal' => 0, 'totalIncome' => 0, 'totalExpense' => 0];

    foreach ($transactions as $transaction) {

        $totals['netTotal'] += $transaction['amount'];

        if ($transaction['amount'] >= 0) {
            $totals['totalIncome'] += $transaction['amount'];
        } else {
            $totals['totalExpense'] += $transaction['amount'];
        }
    }

    return $totals;
}
