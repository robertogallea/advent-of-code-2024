<?php

namespace Robertogallea\AdventOfCode2024;

use Exception;
use Generator;
use IteratorIterator;

class Day06
{
    public function solveFirstPart($list): int
    {
        $map = $this->parseMap($list);

        return $this->runSimulation($map);
    }

    public function solveSecondPart($list): int
    {
        $loops = 0;

        $map = $this->parseMap($list);

        for ($i = 0; $i < count($map); $i++) {
            for ($j = 0; $j < count($map[$i]); $j++) {
                $newMap = $map;
                if (in_array($newMap[$i][$j], ['^', '#'])) {
                    continue;
                }

                $newMap[$i][$j] = '#';
                try {
                    $this->runSimulation($newMap);
                } catch (LoopException $exception) {
                    $loops++;
                }
            }
        }
        return $loops;

    }

    private function parseMap($list)
    {
        return array_map('str_split', explode("\n", $list));
    }

    private function runSimulation(array $map)
    {
        [$position, $orientation] = $this->getPosition($map);
        $visitedPositions = [];
        $visitedObstacles = [
            Orientation::UP->value => [],
            Orientation::DOWN->value => [],
            Orientation::LEFT->value => [],
            Orientation::RIGHT->value => [],
        ];
        while ($this->inBounds($position, $map)) {
            if (rand(1, 100) == 1) {
                // 1% chance of checking for loops. Doesn't matter when doing
                $this->checkNotLooped($visitedObstacles);
            }
            $visitedPositions[$this->linearizePosition($position, $map)] = true;
            $orientation = $this->findDirection($map, $position, $orientation, $visitedObstacles);

            [$map, $position] = $this->move($map, $position, $orientation);
        }

        return count($visitedPositions);
    }

    private function getPosition(array $map): ?array
    {
        for ($i = 0; $i < count($map); $i++) {
            for ($j = 0; $j < count($map[$i]); $j++) {
                if (in_array($map[$i][$j], array_map(fn ($enum) => $enum->value, Orientation::cases()))) {
                    return [[$i, $j], Orientation::from($map[$i][$j])];
                }
            }
        }
        return null;
    }

    private function findDirection(
        array $map,
        mixed $position,
        mixed $orientation,
        array &$visitedObstacles
    ): Orientation {
        switch ($orientation) {
            case Orientation::UP:
                if ($map[$position[0] - 1][$position[1]] == '#') {
                    $visitedObstacles[Orientation::UP->value][] = $this->linearizePosition([
                        $position[0] - 1, $position[1]
                    ], $map);
                    $orientation = Orientation::RIGHT;
                    return $this->findDirection($map, $position, $orientation, $visitedObstacles);
                }
                break;
            case Orientation::DOWN:
                if ($map[$position[0] + 1][$position[1]] == '#') {
                    $visitedObstacles[Orientation::DOWN->value][] = $this->linearizePosition([
                        $position[0] + 1, $position[1]
                    ], $map);
                    $orientation = Orientation::LEFT;
                    return $this->findDirection($map, $position, $orientation, $visitedObstacles);
                }
                break;
            case Orientation::LEFT:
                if ($map[$position[0]][$position[1] - 1] == '#') {
                    $visitedObstacles[Orientation::LEFT->value][] = $this->linearizePosition([
                        $position[0], $position[1] - 1
                    ], $map);
                    $orientation = Orientation::UP;
                    return $this->findDirection($map, $position, $orientation, $visitedObstacles);
                }
                break;
            case Orientation::RIGHT:
                if ($map[$position[0]][$position[1] + 1] == '#') {
                    $visitedObstacles[Orientation::RIGHT->value][] = $this->linearizePosition([
                        $position[0], $position[1] + 1
                    ], $map);
                    $orientation = Orientation::DOWN;
                    return $this->findDirection($map, $position, $orientation, $visitedObstacles);
                }
                break;
        }


        return $orientation;
    }

    private function dumpMap(array $map)
    {
        echo(implode(
            "\n",
            array_map(
                fn ($location) => implode('', $location),
                $map
            )
        )."\n\n");
    }

    private function move(mixed $map, mixed $position, Orientation $orientation)
    {
        $map[$position[0]][$position[1]] = 'X';

        switch ($orientation) {
            case Orientation::UP:
                $position[0]--;
                break;
            case Orientation::DOWN:
                $position[0]++;
                break;
            case Orientation::LEFT:
                $position[1]--;
                break;
            case Orientation::RIGHT:
                $position[1]++;
                break;
        }

        return [$map, $position];
    }

    private function inBounds(mixed $position, mixed $map)
    {
        $oob = $position[0] < 0 || $position[0] > count($map) - 1 || $position[1] < 0 || $position[1] > count($map) - 1;

        return !$oob;
    }

    private function linearizePosition(array $position, array $map)
    {
        return $position[0] * count($map) + $position[1];
    }

    private function checkNotLooped(array $visitedObstacles)
    {

        foreach ($visitedObstacles as $visitedObstacle) {
            if (count($visitedObstacle) !== count(array_unique($visitedObstacle))) {
                throw new LoopException();
            }
        }

        return false;
    }
}

enum Orientation: string
{
    case UP = '^';
    case RIGHT = '>';
    case LEFT = '<';
    case DOWN = 'v';
}

class LoopException extends Exception
{
}
