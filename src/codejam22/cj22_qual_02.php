<?php

// CodeJam 2022 - Qualificaton Round - Problem 02 - 3D Printing

declare(strict_types=1);

const DEBUG = false;

fscanf(STDIN, "%d", $T);
/** @var int $T */
for ($tc = 1; $tc <= $T; $tc++) {
    // @phpstan-ignore-next-line
    if (DEBUG) {
        error_log("==== Test case #$tc:");
    }
    for ($i = 0; $i < 3; $i++) {
        $ink[$i] = array_map('intval', explode(' ', trim(fgets(STDIN))));
        // @phpstan-ignore-next-line
        if (DEBUG) {
            error_log("printer #$i : inks = " . implode(' ', $ink[$i]));
        }
        foreach ($ink[$i] as $j => $value) {
            $colors[$j][$i] = $value;
        }
    }
    $minColors = array_map('min', $colors);
    $surplus = array_sum($minColors) - 1000000;
    if ($surplus < 0) {
        $result = 'IMPOSSIBLE';
    } else {
        for ($j = 0; $j < 4; $j++) {
            $decr = min($minColors[$j], $surplus);
            $minColors[$j] -= $decr;
            $surplus -= $decr;
        }
        $result = implode(' ', $minColors);
    }
    echo "Case #$tc: $result", PHP_EOL;
}
// To debug: error_log(var_export($var, true)); (equivalent to var_dump)
