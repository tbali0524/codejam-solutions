<?php

// CodeJam 2021 - Round 1C - Problem 03 - Double or NOTing

// phpcs:disable PSR1.Files.SideEffects, PSR1.Classes.ClassDeclaration

declare(strict_types=1);

namespace TBali\CodeJam\CodeJam21Round1cProblem03;

const DEBUG = false;

// --------------------------------------------------------------------
function dup(string $s): string
{
    if ($s == '0') {
        return '0';
    } else {
        return $s . '0';
    }
}

// --------------------------------------------------------------------
function neg(string $s): string
{
    $p = 0;
    while ($p < strlen($s) && $s[$p] == '1') {
        $p++;
    }
    if ($p == strlen($s)) {
        return '0';
    }
    $ans = '';
    while ($p < strlen($s)) {
        $ans .= ($s[$p] == '0' ? '1' : '0');
        $p++;
    }
    return $ans;
}

// --------------------------------------------------------------------
// ---------- main program
fscanf(STDIN, "%d", $T);
/** @var int $T */
for ($tc = 1; $tc <= $T; $tc++) {
    $inp = explode(" ", trim(fgets(STDIN)));
    $S = $inp[0];
    $E = $inp[1];
    // error_log("$S $E : " . dup($S) . " " . dup($E) . " : " . neg($S) . " " . neg($E));
    $visited = [];
    $visited[$S] = true;
    $q = [];
    $q[0] = [$S, 0];
    $qWriteIdx = 1;
    $qReadIdx = 0;
    $ans = 0;
    while (true) {
        if ($qReadIdx >= $qWriteIdx) {
            $ans = "IMPOSSIBLE";
            break;
        }
        $curr = $q[$qReadIdx++];
        $currBin = $curr[0];
        $currSteps = $curr[1];
        if ($currBin == $E) {
            $ans = $currSteps;
            break;
        }
        $nextBin = dup($currBin);
        if (!isset($visited[$nextBin])) {
            if (strlen($nextBin) < strlen($S) + 8) {
                $visited[$nextBin] = true;
                $q[$qWriteIdx++] = [$nextBin, $currSteps + 1];
            }
        }
        $nextBin = neg($currBin);
        if (!isset($visited[$nextBin])) {
            $visited[$nextBin] = true;
            $q[$qWriteIdx++] = [$nextBin, $currSteps + 1];
        }
    }
    echo "Case #$tc: $ans", PHP_EOL;
}
// To debug: error_log(var_export($var, true)); (equivalent to var_dump)
