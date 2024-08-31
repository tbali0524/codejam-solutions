<?php

// CodeJam 2021 - Round 2 - Problem 03 - Hidden Pancakes
// NOT READY

declare(strict_types=1);

$p = 1000000007;
fscanf(STDIN, '%d', $T);
/** @var int $T */
for ($tc = 1; $tc <= $T; ++$tc) {
    fscanf(STDIN, '%d', $N);
    /** @var int $N */
    $input = explode(' ', trim(fgets(STDIN)));
    $v = [];
    for ($i = 0; $i < $N; ++$i) {
        $v[$i] = intval($input[$i]);
    }
    $isValid = ($v[0] == 1);
    for ($i = 1; $i < $N; ++$i) {
        if ($v[$i] > $v[$i - 1] + 1) {
            $isValid = false;
            break;
        }
    }
    if (!$isValid) {
        $ans = 0;
        echo 'Case #' . $tc . ': ' . $ans, PHP_EOL;
        continue;
    }

    $ans = 1;
    echo 'Case #' . $tc . ': ' . $ans, PHP_EOL;
}
// To debug: error_log(var_export($var, true)); (equivalent to var_dump)
