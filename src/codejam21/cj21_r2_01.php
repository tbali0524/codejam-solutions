<?php

// CodeJam 2021 - Round 2 - Problem 01 - Minimum Sort

declare(strict_types=1);

fscanf(STDIN, "%d %d", $T, $N);
/** @var int $T */
/** @var int $N */
for ($tc = 1; $tc <= $T; $tc++) {
    $lastSorted = 0;
    while (true) {
        if ($lastSorted >= $N - 1) {
            echo "D", PHP_EOL;
            fscanf(STDIN, "%d", $result);
            /** @var int $result */
            if ($result == 1) {
                break;
            } else {
                exit();
            }
        }
        echo "M " . strval($lastSorted + 1) . " " . strval($N), PHP_EOL;
        fscanf(STDIN, "%d", $result);
        /** @var int $result */
        if ($result == $lastSorted + 1) {
            $lastSorted++;
            continue;
        }
        echo "S " . strval($lastSorted + 1) . " " . strval($result), PHP_EOL;
        fscanf(STDIN, "%d", $result);
        /** @var int $result */
        $lastSorted++;
    }
}
// To debug: error_log(var_export($var, true)); (equivalent to var_dump)
