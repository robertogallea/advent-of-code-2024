<?php

namespace Robertogallea\AdventOfCode2024;

use SplPriorityQueue;

class Day18
{
    public function solveFirstPart(string $input, int $gridSize, int $nBytes): string
    {
        $bytesCoords = $this->parseInput($input);

        $map = $this->buildMap($bytesCoords, $gridSize, $nBytes);

        return $this->findShortestPath($map, [0, 0], [$gridSize - 1, $gridSize - 1]);
    }

    public function solveSecondPart(string $input, int $gridSize): string
    {
        $bytesCoords = $this->parseInput($input);

        for ($i = 0; $i < count($bytesCoords); $i++) {
            $map = $this->buildMap($bytesCoords, $gridSize, $i);
            $minCost = $this->findShortestPath($map, [0, 0], [$gridSize - 1, $gridSize - 1]);
            if ($minCost === null) {
                return implode(',', $bytesCoords[$i - 1]);
            }

        }
        return '-1,-1';
    }


    private function parseInput(string $input): array
    {
        return array_map(fn ($row) => explode(',', $row), explode(PHP_EOL, $input));
    }

    private function findShortestPath(array $grid, array $start, array $end): ?int
    {
        $rows = count($grid);
        $cols = count($grid[0]);

        $directions = [
            [-1, 0], // North
            [1, 0],  // South
            [0, -1], // West
            [0, 1]   // East
        ];

        $queue = [];
        $visited = array_fill(0, $rows, array_fill(0, $cols, false));

        $queue[] = [$start[0], $start[1], 0];
        $visited[$start[0]][$start[1]] = true;

        while (!empty($queue)) {
            [$x, $y, $distance] = array_shift($queue);

            // Arrived at destination, exit with cost
            if ($x == $end[0] && $y == $end[1]) {
                return $distance;
            }

            foreach ($directions as [$dx, $dy]) {
                $nx = $x + $dx;
                $ny = $y + $dy;

                // Is next cell free?
                if ($nx >= 0 && $ny >= 0 && $nx < $rows && $ny < $cols &&
                    !$visited[$nx][$ny] && $grid[$nx][$ny] == '.') {
                    $queue[] = [$nx, $ny, $distance + 1];
                    $visited[$nx][$ny] = true;
                }
            }
        }

        return null;
    }


    private function initializeEmptyMap(int $gridSize): array
    {
        return array_fill(0, $gridSize, array_fill(0, $gridSize, '.'));
    }

    private function buildMap(array $bytesCoords, int $gridSize, int $nBytes): array
    {
        $map = $this->initializeEmptyMap($gridSize);

        foreach (range(0, $nBytes - 1) as $i) {
            $map[$bytesCoords[$i][1]][$bytesCoords[$i][0]] = '#';
        }

        return $map;
    }

    private function dumpMap(array $map): void
    {
        for ($i = 0; $i < count($map); $i++) {
            for ($j = 0; $j < count($map); $j++) {
                echo $map[$i][$j];
            }
            echo PHP_EOL;
        }
    }

}
