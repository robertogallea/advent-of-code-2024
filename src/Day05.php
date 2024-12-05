<?php

namespace Robertogallea\AdventOfCode2024;

use Exception;
use Generator;
use IteratorIterator;

class Day05
{
    public function solveFirstPart($list): int
    {
        [$rules, $updates] = $this->readInput($list);

        return $this->evaluateUpdates($updates, $rules);
    }

    public function solveSecondPart($list): int
    {
        [$rules, $updates] = $this->readInput($list);

        return $this->evaluateUpdates($updates, $rules, strategy: 'respectOrderWithPermutations');
    }

    private function readInput($list): array
    {
        $sections = explode("\n\n", $list);
        $rules = array_map(fn ($rule) => explode("|", $rule), explode("\n", $sections[0]));
        $updates = array_map(fn ($update) => explode(",", $update), explode("\n", $sections[1]));

        return [$rules, $updates];
    }

    private function evaluateUpdates(array $updates, array $rules, string $strategy = 'respectOrder')
    {
        $result = 0;

        foreach ($updates as $update) {
            if (($value = $this->{$strategy}($update, $rules)) > -1) {
                $result += $value;
            }
        }

        return $result;
    }

    public function respectOrder(mixed $update, mixed $rules): int
    {
        for ($i = 0; $i < count($update); $i++) {
            for ($j = $i + 1; $j < count($update); $j++) {
                $respectRule = false;
                foreach ($rules as $rule) {
                    if ((($rule[0] == $update[$i]) && ($rule[1] == $update[$j]))) {
                        $respectRule = true;
                        break;
                    }
                }
                if (!$respectRule) {
                    return -1;
                }
            }
        }

        return $update[floor((float) count($update) / 2)];
    }

    private function respectOrderWithPermutations(mixed $update, mixed $rules): int
    {

        if ($this->respectOrder($update, $rules) > -1) {
            return 0;
        }

        while ($this->respectOrder($update, $rules) < 0) {
            for ($i = 0;$i < count($update);$i++) {
                for ($j = $i + 1;$j < count($update);$j++) {
                    if (in_array([$update[$j], $update[$i]], $rules)) {
                        $temp = $update[$i];
                        $update[$i] = $update[$j];
                        $update[$j] = $temp;
                    }
                }
            }
        }

        return $update[floor((float) count($update) / 2)];
    }
}
