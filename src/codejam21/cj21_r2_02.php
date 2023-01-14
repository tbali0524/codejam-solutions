<?php

// CodeJam 2021 - Round 2 - Problem 02 - Matrygons

// phpcs:disable PSR1.Files.SideEffects, PSR1.Classes.ClassDeclaration

declare(strict_types=1);

namespace TBali\CodeJam\CodeJam21Round2Problem02;

function isPrime(int $x): bool
{
    for ($i = 2; $i < $x; $i++) {
        if ($x % $i == 0) {
            return false;
        }
    }
    return true;
}

function getAns(int $last, int $N): int
{
    if ($N < 0) {
        return -100;
    }
    if ($N <= 2) {
        return 0;
    }
    if ($last >= $N) {
        return -100;
    }
    if (isPrime($N)) {
        return 1;
    }
    $half = intdiv($N, 2) + 1;
    $from = max(2 * $last, 3);
    $step = max($last, 1);
    $best = -100;
    for ($i = $from; $i <= $N; $i += $step) {
        if ($N % $i != 0) {
            continue;
        }
        $sol = 1 + getAns($i, $N - $i);
        if (($sol > $best) and ($sol > 0)) {
            $best = $sol;
        }
    }
    return $best;
}

fscanf(STDIN, "%d", $T);
/** @var int $T */
for ($tc = 1; $tc <= $T; $tc++) {
    fscanf(STDIN, "%d", $N);
    /** @var int $N */
    $ans = getAns(1, $N);
    echo "Case #" . $tc . ": " . $ans, PHP_EOL;
}
// To debug: error_log(var_export($var, true)); (equivalent to var_dump)
