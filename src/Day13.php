<?php

namespace Robertogallea\AdventOfCode2024;

class Day13
{
    public function solveFirstPart(string $input): int
    {
        $machines = $this->parseInput($input);
        return $this->findTokens($machines);
    }

    public function solveSecondPart(string $input): int
    {
        $machines = $this->parseInput($input, true);
        return $this->findTokens($machines);
    }

    private function parseInput(string $input, bool $withCorrection = false): array
    {
        $result = array();

        $machines = explode(PHP_EOL.PHP_EOL, $input);

        foreach ($machines as $machine) {
            $rows = explode(PHP_EOL, $machine);
            preg_match("/X\+(\d+), Y\+(\d+)/", $rows[0], $matchesA);
            preg_match("/X\+(\d+), Y\+(\d+)/", $rows[1], $matchesB);
            preg_match("/X=(\d+), Y=(\d+)/", $rows[2], $matchesP);

            $result[] = [
                'A' => [
                    'X' => $matchesA[1],
                    'Y' => $matchesA[2],
                ],
                'B' => [
                    'X' => $matchesB[1],
                    'Y' => $matchesB[2],
                ],
                'P' => [
                    'X' => $withCorrection ? intval($matchesP[1]) + 10000000000000 : $matchesP[1],
                    'Y' => $withCorrection ? intval($matchesP[2]) + 10000000000000 : $matchesP[2],
                ]
            ];
        }

        return $result;
    }

    /**
     * @param  array  $machines
     * @return float
     */
    public function findTokens(array $machines): int
    {
        $result = 0;

        foreach ($machines as $machine) {

            $moveX = ($machine['B']['Y'] * $machine['P']['X'] - $machine['B']['X'] * $machine['P']['Y']) /
                (($machine['B']['Y'] * $machine['A']['X']) - ($machine['B']['X'] * $machine['A']['Y']));
            $moveY = (($machine['A']['X'] * $machine['B']['X'] * $machine['P']['Y']) - ($machine['P']['X'] * $machine['B']['X'] * $machine['A']['Y'])) /
                ($machine['B']['X'] * (($machine['B']['Y'] * $machine['A']['X']) - ($machine['B']['X'] * $machine['A']['Y'])));

            if ((intval($moveX) == $moveX) && ((intval($moveY) == $moveY))) {
                $result += 3 * $moveX + $moveY;
            }
        }
        return $result;
    }

}
