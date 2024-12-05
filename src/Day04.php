<?php

namespace Robertogallea\AdventOfCode2024;

class Day04
{
    public function solveFirstPart($list): int
    {
        $input = $this->convertInputToArray($list);
        $count = 0;

        for ($i = 0; $i < count($input); $i++) {
            for ($j = 0; $j < count($input[$i]); $j++) {
                $count += $this->searchForXMAS($i, $j, $input);
            }
        }

        return $count;
    }

    public function solveSecondPart($list): int
    {
        $input = $this->convertInputToArray($list);
        $count = 0;

        for ($i = 0; $i < count($input); $i++) {
            for ($j = 0; $j < count($input[$i]); $j++) {
                $count += $this->searchForXShapedMAS($i, $j, $input);
            }
        }

        return $count;
    }

    private function convertInputToArray(string $list): array
    {
        $lines = explode("\n", $list);
        return array_map(fn ($line) => str_split($line), $lines);
    }

    private function searchForXMAS(int $i, int $j, array $input): int
    {
        $count = 0;
        // NW
        if (
            ($input[$i][$j] === 'X') &&
            ($input[$i - 1][$j - 1] === 'M') &&
            ($input[$i - 2][$j - 2] === 'A') &&
            ($input[$i - 3][$j - 3] === 'S')
        ) {
            $count++;
        }

        // W
        if (
            ($input[$i][$j] === 'X') &&
            ($input[$i][$j - 1] === 'M') &&
            ($input[$i][$j - 2] === 'A') &&
            ($input[$i][$j - 3] === 'S')
        ) {
            $count++;
        }

        // SW
        if (
            ($input[$i][$j] === 'X') &&
            ($input[$i + 1][$j - 1] === 'M') &&
            ($input[$i + 2][$j - 2] === 'A') &&
            ($input[$i + 3][$j - 3] === 'S')
        ) {
            $count++;
        }

        // NE
        if (
            ($input[$i][$j] === 'X') &&
            ($input[$i - 1][$j + 1] === 'M') &&
            ($input[$i - 2][$j + 2] === 'A') &&
            ($input[$i - 3][$j + 3] === 'S')
        ) {
            $count++;
        }

        // E
        if (
            ($input[$i][$j] === 'X') &&
            ($input[$i][$j + 1] === 'M') &&
            ($input[$i][$j + 2] === 'A') &&
            ($input[$i][$j + 3] === 'S')
        ) {
            $count++;
        }

        // SE
        if (
            ($input[$i][$j] === 'X') &&
            ($input[$i + 1][$j + 1] === 'M') &&
            ($input[$i + 2][$j + 2] === 'A') &&
            ($input[$i + 3][$j + 3] === 'S')
        ) {
            $count++;
        }

        // N
        if (
            ($input[$i][$j] === 'X') &&
            ($input[$i - 1][$j] === 'M') &&
            ($input[$i - 2][$j] === 'A') &&
            ($input[$i - 3][$j] === 'S')
        ) {
            $count++;
        }

        // S
        if (
            ($input[$i][$j] === 'X') &&
            ($input[$i + 1][$j] === 'M') &&
            ($input[$i + 2][$j] === 'A') &&
            ($input[$i + 3][$j] === 'S')
        ) {
            $count++;
        }


        return $count;
    }

    private function searchForXShapedMAS(int $i, int $j, array $input): int
    {

        if ($input[$i][$j] !== 'A') {
            return 0;
        }

        /*
         * M.M
         * .A.
         * S.S
         */
        if (
            ($input[$i - 1][$j - 1] === 'M') &&
            ($input[$i + 1][$j + 1] === 'S') &&
            ($input[$i - 1][$j + 1] === 'M') &&
            ($input[$i + 1][$j - 1] === 'S')
        ) {
            return 1;
        }

        /*
         * S.S
         * .A.
         * M.M
         */
        if (
            ($input[$i - 1][$j - 1] === 'S') &&
            ($input[$i + 1][$j + 1] === 'M') &&
            ($input[$i - 1][$j + 1] === 'S') &&
            ($input[$i + 1][$j - 1] === 'M')
        ) {
            return 1;
        }

        /*
         * S.M
         * .A.
         * S.M
         */
        if (
            ($input[$i - 1][$j - 1] === 'S') &&
            ($input[$i + 1][$j + 1] === 'M') &&
            ($input[$i - 1][$j + 1] === 'M') &&
            ($input[$i + 1][$j - 1] === 'S')
        ) {
            return 1;
        }

        /*
         * M.S
         * .A.
         * M.S
         */
        if (
            ($input[$i - 1][$j - 1] === 'M') &&
            ($input[$i + 1][$j + 1] === 'S') &&
            ($input[$i - 1][$j + 1] === 'S') &&
            ($input[$i + 1][$j - 1] === 'M')
        ) {
            return 1;
        }

        return 0;
    }

}
