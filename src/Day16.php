<?php

namespace Robertogallea\AdventOfCode2024;

use SplPriorityQueue;

class Day16
{
    public function solveFirstPart(string $input): int
    {
        $map = $this->readMap($input);

        [$from, $to] = $this->findExtrema($map);

        [$score, $paths] = $this->findShortestPaths($map, $from, $to, DIRECTIONS['E'], 1000);

        return $score;

    }

    public function solveSecondPart(string $input): int
    {
        $map = $this->readMap($input);

        [$from, $to] = $this->findExtrema($map);

        [$score, $paths] = $this->findShortestPaths($map, $from, $to, DIRECTIONS['E'], 1000);

        $result = array_reduce($paths, fn ($carry, $path) => array_merge($carry, $path), []);
        $result = array_map(fn ($path) => sprintf("%d-%d", $path[0], $path[1]), $result);
        $result = array_unique($result);

        return count($result);
    }

    private function readMap(string $input): array
    {
        return array_map('str_split', explode(PHP_EOL, $input));
    }


    private function dumpColouredMap(
        array $map
    ) {
        foreach ($map as $row) {
            foreach ($row as $cell) {
                echo match ($cell) {
                    MazeToken::ROBOT->value => "\033[32m",
                    MazeToken::BOX->value, MazeToken::LEFT_BOX->value, MazeToken::RIGHT_BOX->value => "\033[33m",
                    MazeToken::WALL->value => "\033[31m",
                    MazeToken::FREE->value => "\033[30m",
                    default => "\033[0m",
                }.$cell;
            }
            echo PHP_EOL;
        }
    }

    private function dumpMap(
        array $map
    ) {
        foreach ($map as $row) {
            echo implode('', $row).PHP_EOL;
        }
    }

    private function findExtrema(array $map): ?array
    {
        $start = $end = null;

        foreach ($map as $i => $row) {
            foreach ($row as $j => $cell) {
                if ($cell === MazeToken::START->value) {
                    $start = [$i, $j];
                }

                if ($cell === MazeToken::END->value) {
                    $end = [$i, $j];
                }
            }
        }

        return [$start, $end];
    }


    private function findShortestPaths(array $grid, array $start, array $end, array $initialDir, int $turnCost): array
    {
        $rows = count($grid);
        $cols = count($grid[0]);


        $queue = new SplPriorityQueue();
        $queue->setExtractFlags(SplPriorityQueue::EXTR_BOTH);

        $visited = [];

        $solutions = [];
        $minCost = PHP_INT_MAX;

        $queue->insert([$start[0], $start[1], $initialDir, 0, [[$start[0], $start[1]]]], 0);

        while (!$queue->isEmpty()) {
            $current = $queue->extract();
            [$r, $c, $dir, $cost, $path] = $current['data'];

            // if outside grid or on a wall, skip
            if ($r < 0 || $r >= $rows || $c < 0 || $c >= $cols || $grid[$r][$c] === '#') {
                continue;
            }

            if ($r == $end[0] && $c == $end[1]) {
                if ($cost < $minCost) {
                    $solutions = [$path];
                    $minCost = $cost;
                } elseif ($cost == $minCost) {
                    $solutions[] = $path;
                }
                continue;
            }

            $key = "$r,$c,$dir";
            if (isset($visited[$key]) && $visited[$key] < $cost) {
                continue;
            }
            $visited[$key] = $cost;

            foreach (DIRECTIONS as $newDir => $move) {
                $newR = $r + $move[0];
                $newC = $c + $move[1];
                $newCost = $cost + 1;

                if ($newDir !== $dir) {
                    $newCost += $turnCost;
                }

                $queue->insert([$newR, $newC, $newDir, $newCost, array_merge($path, [[$newR, $newC]])], -$newCost);
            }
        }

        return [$minCost, $solutions];
    }

    private function dumpPath(array $map, $path)
    {
        echo "\n";
        foreach ($map as $i => $row) {
            foreach ($row as $j => $cell) {
                if (in_array([$i, $j], $path)) {
                    echo 'O';
                } else {
                    echo $cell;
                }
            }
            echo "\n";
        }
        echo "\n";
    }

}


enum MazeToken: string
{
    case WALL = '#';
    case FREE = '.';
    case START = 'S';
    case END = 'E';
}

const DIRECTIONS = [
    'N' => [-1, 0],  // North
    'S' => [1, 0],   // South
    'E' => [0, 1],   // East
    'W' => [0, -1],  // West
];
