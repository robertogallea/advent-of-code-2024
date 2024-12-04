<?php

namespace Robertogallea\AdventOfCode2024;

class Day03
{
    public function solveFirstPart($list): int
    {
        return $this->executeInstructions($list);
    }

    public function solveSecondPart($list): int
    {
        $list .= 'do'; // to handle the case when there is a final `do`

        $initial = $this->executeInstructions($list);

        $matches = [];

        $pattern = "/don't\\(\\)(.*?)do\\(\\)/s";

        preg_match_all($pattern, $list, $matches);
        return array_reduce(
            $matches[1],
            fn ($carry, $item) => $carry - $this->executeInstructions($item),
            $initial
        );
    }

    public function executeInstructions($list): int
    {
        $matches = [];
        $pattern = '/mul\((\d+),(\d+)\)/';
        preg_match_all($pattern, $list, $matches);
        return array_reduce(
            array_map(function ($num1, $num2) {
                return $num1 * $num2;
            }, $matches[1], $matches[2]),
            fn ($num1, $num2) => $num1 + $num2
        );
    }

}
