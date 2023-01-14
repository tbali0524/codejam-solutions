<?php

// CodeJam 2021 - Round 1C - Problem 01 - Closest Pick

declare(strict_types=1);

const DEBUG = false;

fscanf(STDIN, "%d", $T);
/** @var int $T */
for ($tc = 1; $tc <= $T; $tc++) {
    fscanf(STDIN, "%d %d", $N, $K);
    /** @var int $N */
    /** @var int $K */
    $s = explode(" ", trim(fgets(STDIN)));
    $p = [];
    for ($i = 0; $i < $N; $i++) {
        $p[$i] = intval($s[$i]);
    }
    sort($p);
    $winSingle = [];
    $winBoth = [];
    if ($p[0] > 1) {
        $winSingle[] = $p[0] - 1;
    }
    if ($p[count($p) - 1] < $K) {
        $winSingle[] = $K - $p[count($p) - 1];
    }
    for ($i = 1; $i < $N; $i++) {
        $d = $p[$i] - $p[$i - 1];
        if ($d > 1) {
            $winSingle[] = 1 + intdiv($d - 2, 2);
        }
        if ($d > 2) {
            $winBoth[] = $d - 1;
        }
    }
    $best = 0;
    rsort($winSingle);
    rsort($winBoth);
    if (count($winSingle) >= 2) {
        $best = $winSingle[0] + $winSingle[1];
    } elseif (count($winSingle) == 1) {
        $best = $winSingle[0];
    }
    if (count($winBoth) > 0) {
        $best = max($best, $winBoth[0]);
    }
    $ans = $best / $K;
    // error_log("  S: " . implode(" ", $winSingle));
    // error_log("  B: " . implode(" ", $winBoth));
    echo "Case #$tc: $ans", PHP_EOL;
}
// To debug: error_log(var_export($var, true)); (equivalent to var_dump)
