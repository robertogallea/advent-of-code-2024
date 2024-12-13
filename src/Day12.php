<?php

namespace Robertogallea\AdventOfCode2024;

class Day12
{
    public function solveFirstPart(string $input): int
    {
        $garden = $this->parseInput($input);

        $components = $this->findConnectedComponents($garden);

        $result = 0;
        foreach ($components as $component) {
            $perimeter = $this->calculatePerimeter($component, count($garden), count($garden[0]));
            $area = $this->calculateArea($component);
            $result += $perimeter * $area;
        }

        return $result;
    }

    public function solveSecondPart(string $input): int
    {
        $garden = $this->parseInput($input);

        $components = $this->findConnectedComponents($garden);

        $result = 0;
        foreach ($components as $component) {
            $sides = $this->calculateSides($component, count($garden), count($garden[0]));
            $area = $this->calculateArea($component);
            $result += $sides * $area;
        }

        return $result;
    }

    private function findConnectedComponents($matrix): array
    {
        $rows = count($matrix);
        $cols = count($matrix[0]);
        $visited = array_fill(0, $rows, array_fill(0, $cols, false));
        $components = [];


        for ($i = 0; $i < $rows; $i++) {
            for ($j = 0; $j < $cols; $j++) {
                if (!$visited[$i][$j]) {
                    $component = [];
                    $this->dfs($matrix, $visited, $i, $j, $rows, $cols, $component);
                    if (!empty($component)) {
                        $components[] = $component;
                    }
                }
            }
        }

        return $components;
    }

    private function dfs($matrix, &$visited, $i, $j, $rows, $cols, &$component): void
    {
        $directions = [[-1, 0], [1, 0], [0, -1], [0, 1]];
        $stack = [[$i, $j]];
        $letter = $matrix[$i][$j];

        while (!empty($stack)) {
            list($x, $y) = array_pop($stack);
            if ($x < 0 || $x >= $rows || $y < 0 || $y >= $cols || $visited[$x][$y] || $matrix[$x][$y] !== $letter) {
                continue;
            }
            $visited[$x][$y] = true;
            $component[] = [$x, $y];

            foreach ($directions as $direction) {
                $newX = $x + $direction[0];
                $newY = $y + $direction[1];
                $stack[] = [$newX, $newY];
            }
        }
    }

    private function parseInput(string $input): array
    {
        return array_map('str_split', explode("\n", $input));
    }

    private function calculateArea(array $component): int
    {
        return count($component);
    }

    private function calculatePerimeter(mixed $component, $rows, $cols)
    {
        $result = 0;

        foreach ($component as $element) {
            $elementPerimeter = 2;
            if (($element[0] !== 0) || ($element[0] !== $rows - 1)) {
                $elementPerimeter++;
            }

            if (($element[1] !== 0) || ($element[1] !== $cols - 1)) {
                $elementPerimeter++;
            }

            foreach ($component as $otherElement) {
                if (($element !== $otherElement) &&
                    (
                        (($element[0] === $otherElement[0]) && (abs($element[1] - $otherElement[1]) == 1)) ||
                        (($element[1] === $otherElement[1]) && (abs($element[0] - $otherElement[0]) == 1))
                    )
                ) {
                    $elementPerimeter--;
                }
            }
            $result += $elementPerimeter;
        }
        return $result;
    }


    private function calculateSides(mixed $component, int $rows, int $cols): int
    {
        if (count($component) === 1) {
            return 4;
        }

        $result = 0;

        foreach ($component as $element) {
            $neighborhoodResult = 0;

            // traslates w.r.t. the iterated element, the iterated element is now 0,0
            $traslatedComponent = array_map(fn($currentElement) => [
                $currentElement[0] - $element[0], $currentElement[1] - $element[1]
            ], $component);

            $rotatedComponents = [
                $traslatedComponent,
                array_map(fn($currentElement) => [-$currentElement[1], $currentElement[0]], $traslatedComponent),
                array_map(fn($currentElement) => [-$currentElement[0], -$currentElement[1]], $traslatedComponent),
                array_map(fn($currentElement) => [$currentElement[1], -$currentElement[0]], $traslatedComponent),
            ];

            if ($this->hasNormalizedAppendix($rotatedComponents)) {
                $neighborhoodResult += 2;
            } elseif ($this->hasNormalizedEdge($rotatedComponents)) {
                // do nothing but required to skip the next
            } elseif ($cross = $this->hasNormalizedCross($rotatedComponents)) {
                if (!in_array([1, 1], $cross)) {
                    $neighborhoodResult++;
                }
                if (!in_array([1, -1], $cross)) {
                    $neighborhoodResult++;
                }
                if (!in_array([-1, -1], $cross)) {
                    $neighborhoodResult++;
                }
                if (!in_array([-1, 1], $cross)) {
                    $neighborhoodResult++;
                }
            } elseif ($T = $this->hasNormalizedT($rotatedComponents)) {
                if (!in_array([1, 1], $T)) {
                    $neighborhoodResult++;
                }
                if (!in_array([1, -1], $T)) {
                    $neighborhoodResult++;
                }
            } elseif ($L = $this->hasNormalizedL($rotatedComponents)) {
                $neighborhoodResult++;
                if (!in_array([-1, 1], $L)) {
                    $neighborhoodResult++;
                }
            } elseif ($L = $this->hasNormalizedMirroredL($rotatedComponents)) {
                $neighborhoodResult++;
                if (!in_array([-1, -1], $L)) {
                    $neighborhoodResult++;
                }
            }

            $result += $neighborhoodResult;
        }

        return $result;

    }

    private function hasNormalizedAppendix(array $rotatedComponents): bool
    {

        foreach ($rotatedComponents as $rotatedComponent) {
            if (
                (in_array([0, 1], $rotatedComponent)) &&
                !(in_array([1, 0], $rotatedComponent)) &&
                !(in_array([0, -1], $rotatedComponent)) &&
                !(in_array([-1, 0], $rotatedComponent))
            ) {
                return true;
            }
        }

        return false;
    }

    private function hasNormalizedEdge(array $rotatedComponents): bool
    {
        foreach ($rotatedComponents as $rotatedComponent) {

            if (
                (in_array([0, 1], $rotatedComponent)) &&
                !(in_array([1, 0], $rotatedComponent)) &&
                (in_array([0, -1], $rotatedComponent)) &&
                !(in_array([-1, 0], $rotatedComponent))
            ) {
                return true;
            }
        }

        return false;
    }

    private function hasNormalizedCross(array $rotatedComponents): ?array
    {

        if (
            (in_array([0, 1], $rotatedComponents[0])) &&
            (in_array([1, 0], $rotatedComponents[0])) &&
            (in_array([0, -1], $rotatedComponents[0])) &&
            (in_array([-1, 0], $rotatedComponents[0]))
        ) {
            return $rotatedComponents[0];
        }


        return null;
    }

    private function hasNormalizedT(array $rotatedComponents): ?array
    {
        foreach ($rotatedComponents as $rotatedComponent) {
            if (
                (in_array([0, 1], $rotatedComponent)) &&
                (in_array([1, 0], $rotatedComponent)) &&
                (in_array([0, -1], $rotatedComponent)) &&
                !(in_array([-1, 0], $rotatedComponent))
            ) {
                return $rotatedComponent;
            }
        }

        return null;
    }

    private function hasNormalizedL(array $rotatedComponents): ?array
    {
        foreach ($rotatedComponents as $rotatedComponent) {
            if (
                (in_array([0, 1], $rotatedComponent)) &&
                !(in_array([1, 0], $rotatedComponent)) &&
                !(in_array([0, -1], $rotatedComponent)) &&
                (in_array([-1, 0], $rotatedComponent))
            ) {
                return $rotatedComponent;
            }
        }

        return null;
    }

    private function hasNormalizedMirroredL(array $rotatedComponents): ?array
    {
        foreach ($rotatedComponents as $rotatedComponent) {
            if (
                !(in_array([0, 1], $rotatedComponent)) &&
                !(in_array([1, 0], $rotatedComponent)) &&
                (in_array([0, -1], $rotatedComponent)) &&
                (in_array([-1, 0], $rotatedComponent))
            ) {
                return $rotatedComponent;
            }
        }

        return null;
    }
}