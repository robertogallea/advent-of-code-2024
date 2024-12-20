<?php

namespace Robertogallea\AdventOfCode2024;

class Day20
{
    public function solveFirstPart(string $input, int $saving): string
    {
        $map = $this->readMap($input);

        [$from, $to] = $this->findExtrema($map);

        $points = $this->findPath($map, $from);

        return $this->getCheatingPaths($points, $saving, 2);
    }

    public function solveSecondPart(string $input, int $saving): int
    {
        $map = $this->readMap($input);

        [$from, $to] = $this->findExtrema($map);

        $points = $this->findPath($map, $from);

        return $this->getCheatingPaths($points, $saving, 20);
    }

    private function readMap(string $input): array
    {
        return array_map('str_split', explode(PHP_EOL, $input));
    }

    private function findExtrema(array $map): ?array
    {
        $start = $end = null;

        foreach ($map as $i => $row) {
            foreach ($row as $j => $cell) {
                if ($cell === 'S') {
                    $start = [$i, $j];
                }

                if ($cell === 'E') {
                    $end = [$i, $j];
                }
            }
        }

        return [$start, $end];
    }



    private function findPath(array $grid, array $start): array
    {
        $rows = count($grid);
        $cols = count($grid[0]);

        $queue = [$start];
        $visited = array_fill(0, $rows, array_fill(0, $cols, false));
        $visited[$start[0]][$start[1]] = true;

        $directions = [
            [-1, 0], // North
            [1, 0],  // South
            [0, -1], // West
            [0, 1]   // East
        ];

        $visitedPoints = [];

        while (!empty($queue)) {

            [$y, $x] = array_shift($queue);
            $visitedPoints[] = [$y, $x];

            foreach ($directions as $dir) {
                $newY = $y + $dir[0];
                $newX = $x + $dir[1];

                if ($newY >= 0 && $newY < $rows && $newX >= 0 && $newX < $cols &&
                    !$visited[$newY][$newX] && $grid[$newY][$newX] != '#') {

                    $queue[] = [$newY, $newX];
                    $visited[$newY][$newX] = true;
                }
            }
        }

        return $visitedPoints;
    }

    private function manhattanDistance(mixed $point1, mixed $point2)
    {
        return abs($point1[0] - $point2[0]) + abs($point1[1] - $point2[1]);
    }

    public function getCheatingPaths(array $points, int $saving, int $maxDistance): int
    {
        $numOfCheatingPaths = 0;

        foreach (range(0, count($points) - 2) as $i) {
            $point = $points[$i];
            foreach (range($i + 1, count($points) - 1) as $j) {
                $point2 = $points[$j];

                if ($point === $point2) {
                    continue;
                }

                $manhattanDist = $this->manhattanDistance($point, $point2);

                if ($manhattanDist <= $maxDistance) {
                    $dist = $j - $i;
                    $savedDistance = $dist - $manhattanDist;
                    if ($savedDistance >= $saving) {
                        $numOfCheatingPaths++;
                    }
                }
            }
        }
        return $numOfCheatingPaths;
    }
}
