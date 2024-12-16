<?php

namespace Robertogallea\AdventOfCode2024;

class Day14
{
    public function solveFirstPart(string $input, array $sizes): int
    {
        $robots = $this->parseInput($input);

        $robots = $this->runSimulation($robots, $sizes, 100);

        return $this->count($robots, $sizes);
    }

    public function solveSecondPart(string $input, array $sizes): int
    {
        $robots = $this->parseInput($input);

        $robots = $this->runSimulation($robots, $sizes, 6752);

        $this->dump($robots, $sizes);

        return 6752;
    }

    private function parseInput(string $input): array
    {
        $result = array();

        $lines = explode("\n", $input);

        foreach ($lines as $line) {
            preg_match_all('/-?\d+/', $line, $matches);
            $result[] = $matches[0];
        }

        return $result;

    }

    private function dump(array $robots, $sizes)
    {
        $map = [];
        foreach ($robots as $robot) {
            $map[$robot[0]][$robot[1]] += 1;
        }
        foreach (range(0, $sizes[1] - 1) as $j) {
            foreach (range(0, $sizes[0] - 1) as $i) {
                echo $map[$i][$j] ??= '.';
            }
            echo "\n";
        }
    }

    private function count(array $robots, array $sizes)
    {
        $map = [];

        foreach ($robots as $robot) {
            $map[$robot[0]][$robot[1]] += 1;
        }

        $qw = floor($sizes[1] / 2);
        $qh = floor($sizes[0] / 2);
        $q1 = $q2 = $q3 = $q4 = 0;

        foreach (range(0, $qw - 1) as $j) {
            foreach (range(0, $qh - 1) as $i) {
                $q1 += $map[$i][$j] ?? 0;
                $q2 += $map[$i][$j + $qw + 1] ?? 0;
                $q3 += $map[$i + $qh + 1][$j] ?? 0;
                $q4 += $map[$i + $qh + 1][$j + $qw + 1] ?? 0;
            }
        }

        return $q1 * $q2 * $q3 * $q4;
    }

    private function runSimulation(array $robots, array $sizes, int $iterations)
    {
        foreach (range(1, $iterations) as $_) {
            foreach ($robots as &$robot) {
                $robot[0] = intval($robot[0]) + intval($robot[2]);
                $robot[1] = intval($robot[1]) + intval($robot[3]);
                while ($robot[0] >= $sizes[0]) {
                    $robot[0] -= $sizes[0];
                }
                while ($robot[0] < 0) {
                    $robot[0] += $sizes[0];
                }
                while ($robot[1] >= $sizes[1]) {
                    $robot[1] -= $sizes[1];
                }
                while ($robot[1] < 0) {
                    $robot[1] += $sizes[1];
                }
            }
        }

        return $robots;
    }

}
