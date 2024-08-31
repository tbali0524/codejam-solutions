<?php

// CodeJam 2021 - Qualificaton Round - Problem 02 - Moons and Umbrellas

declare(strict_types=1);

const DEBUG = false;

fscanf(STDIN, '%d', $T);
/** @var int $T */
for ($tc = 1; $tc <= $T; ++$tc) {
    $inputs = explode(' ', trim(fgets(STDIN)));
    $X = intval($inputs[0]);
    $Y = intval($inputs[1]);
    $S = $inputs[2];
    // @phpstan-ignore-next-line
    if (DEBUG) {
        error_log('==== Test case #' . strval($tc) . ': X = ' . strval($X) . '; Y = ' . strval($Y) . '; S = ' . $S);
    }
    $ans = 0;
    $i = 0;
    $delta1 = 0;
    while (true) {
        if ($i == strlen($S)) {
            break;
        }
        if ($S[$i] == 'C') {
            if (($i > 0) and ($S[$i - 1] == 'J')) {
                $ans += $Y;
            }
            ++$i;
            continue;
        }
        if ($S[$i] == 'J') {
            if (($i > 0) and ($S[$i - 1] == 'C')) {
                $ans += $X;
            }
            ++$i;
            continue;
        }
        $j = $i + 1;
        while ($j < strlen($S) and $S[$j] == '?') {
            ++$j;
        }
        $start = ($i > 0 ? $S[$i - 1] : ' ');
        $end = ($j < strlen($S) ? $S[$j] : ' ');
        $div = intdiv($j - $i, 2);
        $mod = ($j - $i) % 2;
        // @phpstan-ignore-next-line
        if (DEBUG) {
            error_log("-- current result: {$ans}; section: {$i} - {$j}  : 2 * {$div} + {$mod} : {$start} - {$end}");
        }
        if (($start == 'C') and ($end == ' ')) {
            $delta1 = $X * ($X < 0 ? 1 : 0);
        } elseif (($start == 'J') and ($end == ' ')) {
            $delta1 = $Y * ($Y < 0 ? 1 : 0);
        } elseif (($start == ' ') and ($end == 'C')) {
            $delta1 = $Y * ($Y < 0 ? 1 : 0);
        } elseif (($start == ' ') and ($end == 'J')) {
            $delta1 = $X * ($X < 0 ? 1 : 0);
        } elseif (($start == 'C') and ($end == 'C')) {
            $delta1 = 0;
        } elseif (($start == 'J') and ($end == 'J')) {
            $delta1 = 0;
        } elseif (($start == 'C') and ($end == 'J')) {
            $delta1 = $X;
        } elseif (($start == 'J') and ($end == 'C')) {
            $delta1 = $Y;
        } elseif (($start == ' ') and ($end == ' ')) {
            $delta1 = ($div > 0 ? min(0, $X, $Y) : 0);
        }
        $delta2 = $div * ($X + $Y);
        if (($start == 'C') and ($end == ' ')) {
            $delta2 += $mod * $X * ($X < 0 ? 1 : 0);
        } elseif (($start == 'J') and ($end == ' ')) {
            $delta2 += $mod * $Y * ($Y < 0 ? 1 : 0);
        } elseif (($start == ' ') and ($end == 'C')) {
            $delta2 += $mod * $Y * ($Y < 0 ? 1 : 0);
        } elseif (($start == ' ') and ($end == 'J')) {
            $delta2 += $mod * $X * ($X < 0 ? 1 : 0);
        } elseif (($start == 'C') and ($end == 'C')) {
            $delta2 += $mod * ($X + $Y);
        } elseif (($start == 'J') and ($end == 'J')) {
            $delta2 += $mod * ($X + $Y);
        } elseif (($start == 'C') and ($end == 'J')) {
            $delta2 += $X;
        } elseif (($start == 'J') and ($end == 'C')) {
            $delta2 += $Y;
        } elseif (($start == ' ') and ($end == ' ')) {
            $delta2 += ($div > 0 ? $mod * min(0, $X, $Y) : 0);
        }
        $ans += min($delta1, $delta2);
        // @phpstan-ignore-next-line
        if (DEBUG) {
            error_log(".... {$delta1} {$delta2}; updated result = {$ans}");
        }
        $i = $j;
    }
    echo 'Case #' . $tc . ': ';
    echo $ans, PHP_EOL;
}
// To debug: error_log(var_export($var, true)); (equivalent to var_dump)
