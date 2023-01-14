<?php

// CodeJam 2021 - Round 1C - Problem 02 - Roaring Years

declare(strict_types=1);

const DEBUG = false;

fscanf(STDIN, "%d", $T);
/** @var int $T */
for ($tc = 1; $tc <= $T; $tc++) {
    fscanf(STDIN, "%d", $y);
    /** @var int $y */
    while (true) {
        $y++;
        $s = strval($y);
        $isOk = false;
        for ($i = 1; $i <= intdiv(strlen($s), 2); $i++) {
            $first = substr($s, 0, $i);
            $f = intval($first);
            $pos = strlen($first);
            $isOk = true;
            while ($pos < strlen($s)) {
                $f++;
                $fs = strval($f);
                $next = substr($s, $pos, strlen($fs));
                if ($s[$pos] == '0' || $next != $fs) {
                    $isOk = false;
                    break;
                }
                $pos += strlen($fs);
            }
            if ($isOk) {
                break;
            }
        }
        if ($isOk) {
            break;
        }
    }
    $ans = $y;
    echo "Case #$tc: $ans", PHP_EOL;
}
// To debug: error_log(var_export($var, true)); (equivalent to var_dump)
