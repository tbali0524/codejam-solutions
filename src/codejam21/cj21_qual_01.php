<?php

// CodeJam 2021 - Qualificaton Round - Problem 01 - Reversort

declare(strict_types=1);

const DEBUG = false;

fscanf(STDIN, "%d", $T);
/** @var int $T */
for ($tc = 1; $tc <= $T; $tc++) {
    fscanf(STDIN, "%d", $N);
    /** @var int $N */
    $inputs = explode(" ", trim(fgets(STDIN)));
    $L = [];
    for ($i = 0; $i < $N; $i++) {
        $L[$i] = intval($inputs[$i]);
    }
    // @phpstan-ignore-next-line
    if (DEBUG) {
        error_log("==== Test case #" . strval($tc) . ": N = " . strval($N) . "; seq = " . implode(' ', $L));
    }
    $ans = 0;
    for ($i = 0; $i < $N - 1; $i++) {
        $minIdx = 0;
        $minValue = PHP_INT_MAX;
        for ($j = $i; $j < $N; $j++) {
            if ($L[$j] < $minValue) {
                $minValue = $L[$j];
                $minIdx = $j;
            }
        }
        for ($j = 0; $j < intdiv($minIdx - $i + 1, 2); $j++) {
            $temp = $L[$minIdx - $j];
            $L[$minIdx - $j] = $L[$i + $j];
            $L[$i + $j] = $temp;
        }
        $ans += $minIdx - $i + 1;
        // @phpstan-ignore-next-line
        if (DEBUG) {
            // error_log("-- add: " . strval($minIdx - $i + 1) . "; " . implode(' ', $L));
        }
    }
    echo "Case #" . $tc . ": ";
    echo $ans, PHP_EOL;
}
// To debug: error_log(var_export($var, true)); (equivalent to var_dump)
