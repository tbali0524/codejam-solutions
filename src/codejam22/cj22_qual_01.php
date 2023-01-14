<?php

// CodeJam 2022 - Qualificaton Round - Problem 01 - Punched Cards

declare(strict_types=1);

const DEBUG = false;

fscanf(STDIN, "%d", $T);
/** @var int $T */
for ($tc = 1; $tc <= $T; $tc++) {
    fscanf(STDIN, "%d %d", $R, $C);
    /** @var int $R */
    /** @var int $C */
    // @phpstan-ignore-next-line
    if (DEBUG) {
        error_log("==== Test case #$tc : R = $R; C = $C");
    }
    echo "Case #$tc:", PHP_EOL;
    echo '..' . str_repeat('+-', $C - 1) . '+', PHP_EOL;
    echo '..' . str_repeat('|.', $C - 1) . '|', PHP_EOL;
    for ($y = 1; $y < $R; $y++) {
        echo str_repeat('+-', $C) . '+', PHP_EOL;
        echo str_repeat('|.', $C) . '|', PHP_EOL;
    }
    echo str_repeat('+-', $C) . '+', PHP_EOL;
}
// To debug: error_log(var_export($var, true)); (equivalent to var_dump)
