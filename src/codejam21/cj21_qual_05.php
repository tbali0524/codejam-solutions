<?php

// CodeJam 2021 - Qualificaton Round - Problem 05 - Cheating Detection

declare(strict_types=1);

const DEBUG = false;

$maxPlayers = 100;
$maxQuestions = 10000;
fscanf(STDIN, '%d', $T);
// @var int $T
fscanf(STDIN, '%d', $P);
/** @var int $P */
$assumedSkillsPlayer = array_fill(0, $maxPlayers, 0.0);
for ($i = 0; $i < $maxPlayers; ++$i) {
    $assumedSkillsPlayer[$i] = -3.0 + (6.0 / $maxPlayers) * ($i + 0.5);
    // $assumedSkillsPlayer[$i] = -3.0 + (6.0 / ($maxPlayers + 1)) * $i;
}
$assumedSkillsQuestion = array_fill(0, $maxQuestions, 0.0);
for ($j = 0; $j < $maxQuestions; ++$j) {
    $assumedSkillsQuestion[$j] = -3.0 + (6.0 / $maxQuestions) * ($j + 0.5);
    // $assumedSkillsQuestion[$j] = -3.0 + (6.0 / ($maxQuestions + 1)) * $j;
}
for ($tc = 1; $tc <= $T; ++$tc) {
    for ($i = 0; $i < $maxPlayers; ++$i) {
        $results[$i] = trim(fgets(STDIN));
    }
    $pointsPlayer = array_fill(0, $maxPlayers, 0);
    $pointsQuestion = array_fill(0, $maxQuestions, 0);
    for ($i = 0; $i < $maxPlayers; ++$i) {
        for ($j = 0; $j < $maxQuestions; ++$j) {
            if ($results[$i][$j] == '1') {
                ++$pointsPlayer[$i];
                ++$pointsQuestion[$j];
            }
        }
    }
    arsort($pointsQuestion);
    $sortedQuestionIdx = array_keys($pointsQuestion);
    asort($pointsPlayer);
    $sortedPlayerIdx = array_keys($pointsPlayer);
    $bestDelta = -$maxQuestions;
    $ans = 0;
    for ($i = 0; $i < $maxPlayers; ++$i) {
        $idxPlayer = $sortedPlayerIdx[$i];
        $skillPlayer = $assumedSkillsPlayer[$i];
        $totalDelta = 0;
        for ($j = 0; $j < $maxQuestions; ++$j) {
            $idxQuestion = $sortedQuestionIdx[$j];
            $skillQuestion = $assumedSkillsQuestion[$j];
            $winProbability = 1.0 / (1.0 + exp($skillQuestion - $skillPlayer));
            $expectedPoint = ($winProbability >= 0.5 ? 1 : 0);
            $realPoint = ($results[$idxPlayer][$idxQuestion] == '1' ? 1 : 0);
            $delta = $realPoint - $expectedPoint;
            $totalDelta += $delta;
        }
        $expectedDeltaIfCheating = (1 - $pointsPlayer[$idxPlayer] / $maxQuestions) / 2;
        if ($expectedDeltaIfCheating == 0.0) {
            $expectedDeltaIfCheating = 1.0;
        }
        $discrepancy = $totalDelta / $expectedDeltaIfCheating;
        // @phpstan-ignore-next-line
        if (DEBUG) {
            error_log(strval($i + 1) . '.: #' . strval($idxPlayer + 1)
                . ": skill = {$skillPlayer}; d = {$totalDelta}; err = {$discrepancy}; pts = "
                . strval($pointsPlayer[$idxPlayer]));
        }
        if ($discrepancy > $bestDelta) {
            $bestDelta = $discrepancy;
            $ans = $idxPlayer;
        }
    }
    echo 'Case #' . $tc . ': ' . ($ans + 1), PHP_EOL;
}
// To debug: error_log(var_export($var, true)); (equivalent to var_dump)
