<?php

// CodeJam 2021 - Qualificaton Round - Problem 03 - Reversort Engineering

// phpcs:disable PSR1.Files.SideEffects, PSR1.Classes.ClassDeclaration

declare(strict_types=1);

const DEBUG = false;

// --------------------------------------------------------------------
/** @param int[] &$L */
function extendSolution(array &$L, int $N, int $C): void
{
    $max = intdiv(($N - 1) * ($N + 2), 2);
    if (($C < $N - 1) or ($C > $max)) {
        $L = [];
        return;
    }
    if ($N == 2) {
        if ($C == 1) {
            $L = [1, 2];
        } elseif ($C == 2) {
            $L = [2, 1];
        } else {
            $L = [];
        }
        return;
    }
    if ($C > $max - $N + 1) {
        extendSolution($L, $N - 1, $C - $N);
        if (count($L) == 0) {
            return;
        }
        $L = array_reverse($L);
        $L[] = 0;
    } else {
        extendSolution($L, $N - 1, $C - 1);
        if (count($L) == 0) {
            return;
        }
        array_unshift($L, 0);
    }
    for ($i = 0; $i < count($L); $i++) {
        $L[$i]++;
    }
}

// --------------------------------------------------------------------
// ---------- main program
fscanf(STDIN, "%d", $T);
/** @var int $T */
for ($tc = 1; $tc <= $T; $tc++) {
    fscanf(STDIN, "%d %d", $N, $C);
    /** @var int $N */
    /** @var int $C */
    // @phpstan-ignore-next-line
    if (DEBUG) {
        error_log("==== Test case #" . strval($tc) . ": N = " . strval($N) . "; C = " . strval($C));
    }
    $L = [];
    extendSolution($L, $N, $C);
    echo "Case #" . $tc . ": " . (count($L) == 0 ? "IMPOSSIBLE" : implode(' ', $L)), PHP_EOL;
}
// To debug: error_log(var_export($var, true)); (equivalent to var_dump)
