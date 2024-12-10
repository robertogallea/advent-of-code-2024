<?php

namespace Robertogallea\AdventOfCode2024;

class Day10
{
    public function solveFirstPart(string $input): int
    {
        $map = $this->parseInput($input);


        $result = 0;

        foreach ($map as $i => $row) {
            foreach ($row as $j => $cell) {

                if ($cell == 0) {
                    $visited = [];
                    $map[$i][$j] = '.';
                    $result += $this->countTrails($map, 1, $i, $j, $visited);
                }
            }
        }

        return $result;
    }

    public function solveSecondPart(string $input): int
    {
        $map = $this->parseInput($input);


        $result = 0;

        foreach ($map as $i => $row) {
            foreach ($row as $j => $cell) {

                if ($cell == 0) {
                    $visited = [];
                    $map[$i][$j] = '.';
                    $result += $this->countTrails($map, 1, $i, $j, $visited, true);
                }
            }
        }

        return $result;
    }

    private function parseInput(string $input)
    {
        return array_map('str_split', explode("\n", $input));
    }


    private function countTrails(array $map, int $valueToSearch, int $i, int $j, array &$visited, bool $withRepetitions = false): int
    {

        if (($valueToSearch == 10)) {
            if ($visited["$i-$j"] && !$withRepetitions) {
                return 0;
            }
            $visited["$i-$j"] = true;
            return 1;
        }

        $result = 0;
        $points = [
            [$i - 1, $j],
            [$i, $j - 1],
            [$i, $j + 1],
            [$i + 1, $j],
        ];

        foreach ($points as $point) {
            if ( // should visit the point
                ($point[0] >= 0) && ($point[0] < count($map)) && ($point[1] >= 0) && ($point[1] < count($map[0])) &&
                ($map[$point[0]][$point[1]] != '.') && ($map[$point[0]][$point[1]] == $valueToSearch)
            ) {
                $result += $this->countTrails($map, $valueToSearch + 1, $point[0], $point[1], $visited, $withRepetitions);
            }
        }
        return $result;
    }

    private function dumpMap(array $map, int $ii, int $jj)
    {
        foreach ($map as $i => $row) {
            foreach ($row as $j => $cell) {
                if (($i == $ii) && ($j == $jj)) {
                    echo('+');
                } else {
                    echo($cell);
                }
            }
            echo("\n");
        }
        echo("\n");
    }
}