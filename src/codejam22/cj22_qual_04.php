<?php

// CodeJam 2022 - Qualificaton Round - Problem 04 - Chain Reactions
// wrong

declare(strict_types=1);

const DEBUG = false;

fscanf(STDIN, '%d', $T);
/** @var int $T */
for ($tc = 1; $tc <= $T; ++$tc) {
    fscanf(STDIN, '%d', $N);
    /** @var int $N */
    $F = array_map('intval', explode(' ', trim(fgets(STDIN))));
    $P = array_map('intval', explode(' ', trim(fgets(STDIN))));
    // @phpstan-ignore-next-line
    if (DEBUG) {
        error_log("==== Test case #{$tc} : N = {$N}");
        error_log('F: ' . implode(' ', $F));
        error_log('P: ' . implode(' ', $P));
    }
    $isInitiator = [];
    for ($i = 0; $i < $N; ++$i) {
        if ($P[$i] > 0) {
            $isInitiator[$P[$i] - 1] = false;
        }
    }
    $initiators = [];
    for ($i = 0; $i < $N; ++$i) {
        if ($isInitiator[$i] ?? true) {
            $initiators[] = $i;
        }
    }
    $initsThru = array_fill(0, $N, []);
    foreach ($initiators as $idx => $start) {
        $i = $start;
        while ($i >= 0) {
            $initsThru[$i][] = $idx;
            $i = $P[$i] - 1;
        }
    }
    $isTriggered = [];
    $sortedFun = $F;
    arsort($sortedFun);
    // @phpstan-ignore-next-line
    if (DEBUG) {
        error_log('isInitiator: ' . var_export($isInitiator, true));
        error_log('initiators: ' . var_export($initiators, true));
        error_log('initsThru: ' . var_export($initsThru, true));
        error_log('sortedFun: ' . var_export($sortedFun, true));
    }
    $ans = 0;
    foreach ($sortedFun as $idxModule => $fun) {
        if ($isTriggered[$idxModule] ?? false) {
            continue;
        }
        if (count($initsThru[$idxModule]) == 0) {
            continue;
        }
        $bestMax = PHP_INT_MAX;
        $bestIdxInit = -1;
        foreach ($initsThru[$idxModule] as $idxInit) {
            if ($isTriggered[$initiators[$idxInit]] ?? false) {
                continue;
            }
            $max = 0;
            $i = $initiators[$idxInit];
            while ($i >= 0) {
                if (($i != $idxModule) and (!($isTriggered[$i] ?? false))) {
                    $max = max($max, $F[$i]);
                }
                $i = $P[$i] - 1;
            }
            if ($max < $bestMax) {
                $bestMax = $max;
                $bestIdxInit = $idxInit;
            }
        }
        if ($bestIdxInit < 0) {
            continue;
        }
        $i = $initiators[$bestIdxInit];
        while ($i >= 0) {
            $isTriggered[$i] = true;
            $i = $P[$i] - 1;
        }
        $isTriggered[$idxModule] = true;
        $ans += $F[$idxModule];
    }
    echo "Case #{$tc}: {$ans}", PHP_EOL;
}
// To debug: error_log(var_export($var, true)); (equivalent to var_dump)
