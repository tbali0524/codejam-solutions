<?php

// CodeJam 2022 - Round 1B - Problem 02 - Controlled Inflation
// wrong

declare(strict_types=1);

const DEBUG = false;

fscanf(STDIN, "%d", $T);
/** @var int $T */
for ($tc = 1; $tc <= $T; $tc++) {
    fscanf(STDIN, "%d %d", $N, $P);
    /** @var int $N */
    /** @var int $P */
    // @phpstan-ignore-next-line
    if (DEBUG) {
        error_log("==== Test case #$tc: $N $P");
    }
    $X = [];
    $min = [];
    $max = [];
    $result = 0;
    for ($i = 0; $i < $N; $i++) {
        $X[$i] = array_map('intval', explode(' ', trim(fgets(STDIN))));
        sort($X[$i]);
        $min[$i] = min($X[$i]);
        $max[$i] = max($X[$i]);
        // @phpstan-ignore-next-line
        if (DEBUG) {
            error_log(implode(' ', $X[$i]));
            error_log("  min: " . $min[$i] . "; max: " . $max[$i]);
        }
    }
    $prevMin = 0;
    $prevMax = 0;
    $bestMin = 0;
    $bestMax = 0;
    for ($i = 0; $i < $N; $i++) {
        $min2min = abs($max[$i] - $prevMin) + abs($max[$i] - $min[$i]);
        $max2min = abs($max[$i] - $prevMax) + abs($max[$i] - $min[$i]);
        $min2max = abs($min[$i] - $prevMin) + abs($max[$i] - $min[$i]);
        $max2max = abs($min[$i] - $prevMax) + abs($max[$i] - $min[$i]);
        $nextMin = $min[$i];
        $nextMax = $max[$i];
        if ($prevMin <= $min[$i]) {
            $min2min = abs($max[$i] - $prevMin) + abs($max[$i] - $X[$i][1]);
            $nextMin = $X[$i][1];
        }
        if ($prevMax >= $max[$i]) {
            $max2max = abs($min[$i] - $prevMax) + abs($X[$i][$P - 2] - $min[$i]);
            $nextMax = $X[$i][$P - 2];
        }
        $bestMin = min($bestMin + $min2min, $bestMax + $max2min);
        $bestMax = min($bestMin + $min2max, $bestMax + $max2max);
        $prevMin = $nextMin;
        $prevMax = $nextMax;
        // @phpstan-ignore-next-line
        if (DEBUG) {
            error_log("  #$i : min2min: $min2min; max2min: $max2min; min2max: $min2max; max2max: $max2max");
            error_log("         bestMin: $bestMin; bestMax: $bestMax");
        }
    }
    $result = min($bestMin, $bestMax);
    echo "Case #$tc: $result", PHP_EOL;
}
// To debug: error_log(var_export($var, true)); (equivalent to var_dump)
