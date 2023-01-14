<?php

// CodeJam 2021 - Qualificaton Round - Problem 04 - Median Sort

// phpcs:disable PSR1.Files.SideEffects, PSR1.Classes.ClassDeclaration

declare(strict_types=1);

namespace TBali\CodeJam\CodeJam21Qualification04;

const DEBUG = false;

// --------------------------------------------------------------------
// asks the judge, returns [median, other, other]
/** @return int[] */
function getMedian(int $a, int $b, int $c): array
{
    echo $a . ' ' . $b . ' ' .  $c, PHP_EOL;
    fscanf(STDIN, "%d", $median);
    /** @var int $median */
    if ($median == $a) {
        return [$a, $b, $c];
    } elseif ($median == $b) {
        return [$b, $a, $c];
    } elseif ($median == $c) {
        return [$c, $a, $b];
    } elseif ($median == -1) {
        throw new \Exception("No questions left.");
    } else {
        throw new \Exception("Impossible answer from judge: input: $a $b $c; output: $median");
    }
}

// --------------------------------------------------------------------
class Node
{
    public int $value = 0;
    public ?Node $left = null;
    public ?Node $right = null;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    /** @return int[] */
    public function walkInOrder(): array
    {
        if (!is_null($this->left)) {
            $ans = $this->left->walkInOrder();
        } else {
            $ans = [];
        }
        $ans[] = $this->value;
        if (!is_null($this->right)) {
            $ans = array_merge($ans, $this->right->walkInOrder());
        }
        return $ans;
    }

    public function insertValue(int $idx, bool $goLeft = true): void
    {
        if ($goLeft) {
            if (is_null($this->left)) {
                if (!is_null($this->right)) {
                    $this->insertValue($idx, false);
                    return;
                } else {
                    throw new \Exception("Impossible");
                }
            }
            $a = getMedian($idx, $this->value, $this->left->value);
            $median = $a[0];
            if ($median == $this->left->value) {
                if (is_null($this->left->left)) {
                    $this->left->left = new Node($idx);
                    return;
                } else {
                    $this->left->insertValue($idx, true);
                    return;
                }
            } elseif ($median == $idx) {
                if (is_null($this->left->right)) {
                    $this->left->right = new Node($idx);
                    return;
                } else {
                    $this->left->insertValue($idx, false);
                    return;
                }
            } elseif ($median == $this->value) {
                if (is_null($this->right)) {
                    $this->right = new Node($idx);
                    return;
                } else {
                    $this->insertValue($idx, false);
                    return;
                }
            } else {
                throw new \Exception("Impossible");
            }
        } else {
            if (is_null($this->right)) {
                if (!is_null($this->left)) {
                    $this->insertValue($idx, true);
                    return;
                } else {
                    throw new \Exception("Impossible");
                }
            }
            $a = getMedian($idx, $this->value, $this->right->value);
            $median = $a[0];
            if ($median == $this->right->value) {
                if (is_null($this->right->right)) {
                    $this->right->right = new Node($idx);
                    return;
                } else {
                    $this->right->insertValue($idx, false);
                    return;
                }
            } elseif ($median == $idx) {
                if (is_null($this->right->left)) {
                    $this->right->left = new Node($idx);
                    return;
                } else {
                    $this->right->insertValue($idx, true);
                    return;
                }
            } elseif ($median == $this->value) {
                if (is_null($this->left)) {
                    $this->left = new Node($idx);
                    return;
                } else {
                    $this->insertValue($idx, true);
                    return;
                }
            } else {
                throw new \Exception("Impossible");
            }
        }
    }
}

// ---------- main program
fscanf(STDIN, "%d %d %d", $T, $N, $Q);
/** @var int $T */
/** @var int $N */
/** @var int $Q */
$questionsRemaining = $Q;
// @phpstan-ignore-next-line
if (DEBUG) {
    error_log("== T =" . strval($T) . " ; N = " . strval($N) . "; Q = " . strval($Q));
}
for ($tc = 1; $tc <= $T; $tc++) {
    // @phpstan-ignore-next-line
    if (DEBUG) {
        error_log("==== Test case #" . strval($tc));
    }
    $a = getMedian(1, 2, 3);
    $questionsRemaining--;
    $root = new Node($a[0]);
    $root->left = new Node($a[1]);
    $root->right = new Node($a[2]);
    for ($i = 4; $i <= $N; $i++) {
        $root->insertValue($i);
    }
    $ans = $root->walkInOrder();
    echo implode(' ', $ans), PHP_EOL;
    fscanf(STDIN, "%d", $result);
    /** @var int $result */
    if ($result == -1) {
        throw new \Exception("Wrong guess");
    }
}
// To debug: error_log(var_export($var, true)); (equivalent to var_dump)
