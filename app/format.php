<?php

declare (strict_types = 1);

function formatDollar(float $amount): string
{

    $isNegative = $amount < 0;

    return ($isNegative ? '-' : '') . '$' . abs($amount);
}

function formatDate(string $date): string
{
    return date('M j, Y', strtotime($date));
}
