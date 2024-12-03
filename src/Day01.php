<?php

namespace Robertogallea\AdventOfCode2024;

class Day01
{

    public function solveFirstPart(string $list)
    {
        list($left, $right) = $this->prepareInput($list);

        sort($left);
        sort($right);
        $diffs = array_map(fn($first, $second) => abs($first - $second), $left, $right);
        $sum = array_reduce($diffs, fn($first, $second) => $first + $second, 0);

        return $sum;


    }

    public function solveSecondPart($list)
    {
        list($left, $right) = $this->prepareInput($list);

        $similarities = array_map(function ($first) use ($right) {
            $occurrences = 0;
            foreach ($right as $second) {
                if ($first === $second) {
                    $occurrences++;
                }
            }
            return $first * $occurrences;
        }, $left);

        $sum = array_reduce($similarities, fn($first, $second) => $first + $second, 0);

        return $sum;
    }

    /**
     * @param  string  $list
     * @return array[]
     */
    public function prepareInput(string $list): array
    {
        $list = explode("\n", $list);

        $left = [];
        $right = [];

        foreach ($list as $item) {
            [$firstPart, $secondPart] = preg_split('/\s+/', $item, 2);
            $left[] = $firstPart;
            $right[] = $secondPart;
        }
        return array($left, $right);
    }
}