<?php

// CodeJam 2022 - Round 1B - Problem 01 - Pancake Deque

declare(strict_types=1);

const DEBUG = false;

fscanf(STDIN, '%d', $T);
/** @var int $T */
for ($tc = 1; $tc <= $T; ++$tc) {
    fscanf(STDIN, '%d', $N);
    /** @var int $N */
    $D = array_map('intval', explode(' ', trim(fgets(STDIN))));
    // @phpstan-ignore-next-line
    if (DEBUG) {
        error_log("==== Test case #{$tc}: {$N}");
        error_log(var_export($D, true));
    }
    $left = 0;
    $right = $N - 1;
    $highest = ~PHP_INT_MAX;
    $result = 0;
    while ($left <= $right) {
        if ($D[$left] <= $D[$right]) {
            $next = $D[$left];
            ++$left;
        } else {
            $next = $D[$right];
            --$right;
        }
        if ($next >= $highest) {
            ++$result;
            $highest = $next;
        }
    }
    echo "Case #{$tc}: {$result}", PHP_EOL;
}
// To debug: error_log(var_export($var, true)); (equivalent to var_dump)
