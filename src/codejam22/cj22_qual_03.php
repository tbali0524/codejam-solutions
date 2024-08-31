<?php

// CodeJam 2022 - Qualificaton Round - Problem 03 - d1000000

declare(strict_types=1);

const DEBUG = false;

fscanf(STDIN, '%d', $T);
/** @var int $T */
for ($tc = 1; $tc <= $T; ++$tc) {
    // @phpstan-ignore-next-line
    if (DEBUG) {
        error_log("==== Test case #{$tc}:");
    }
    fscanf(STDIN, '%d', $N);
    /** @var int $N */
    $S = array_map('intval', explode(' ', trim(fgets(STDIN))));
    // @phpstan-ignore-next-line
    if (DEBUG) {
        error_log("{$N} dice with sides: " . implode(' ', $S));
    }
    sort($S);
    $result = 1;
    $idxDice = 0;
    while (true) {
        while (($idxDice < $N) and (($S[$idxDice] ?? 0) < $result)) {
            ++$idxDice;
        }
        if ($idxDice == $N) {
            --$result;
            break;
        }
        ++$result;
        ++$idxDice;
    }
    echo "Case #{$tc}: {$result}", PHP_EOL;
}
// To debug: error_log(var_export($var, true)); (equivalent to var_dump)
