<?php

namespace Robertogallea\AdventOfCode2024;

class Day08
{
    public function solveFirstPart(string $input): int
    {
        $antinodes = [];
        $map = $this->parseMap($input);
        $types = $this->enumerateAntennaTypes($map);
        foreach ($types as $type) {
            $typedMap = $this->getTypedMap($map, $type);
            $antinodes = array_merge(
                $antinodes,
                $this->countAntinodes($typedMap, $type),
            );

        }

        return count($antinodes);
    }

    public function solveSecondPart(string $input): int
    {
        $antinodes = [];
        $map = $this->parseMap($input);
        $types = $this->enumerateAntennaTypes($map);
        foreach ($types as $type) {
            $typedMap = $this->getTypedMap($map, $type);
            $antinodes = array_merge(
                $antinodes,
                $this->countAntinodesWithSameLocation($typedMap, $type),
            );


        }
        return count($antinodes);
    }

    private function parseMap(string $input)
    {
        return array_map('str_split', explode("\n", $input));
    }

    private function enumerateAntennaTypes(array $map)
    {
        return array_diff(
            array_unique(array_reduce($map, fn ($item, $carry) => array_merge($item, $carry), [])),
            ['.']
        );
    }

    private function getTypedMap(array $map, mixed $type)
    {
        foreach ($map as &$row) {
            foreach ($row as &$cell) {
                if ($cell !== $type) {
                    $cell = '.';
                }
            }
        }
        return $map;
    }

    private function dumpMap(array $typedMap)
    {
        foreach ($typedMap as $row) {
            foreach ($row as $cell) {
                echo $cell;
            }
            echo PHP_EOL;
        }
        echo PHP_EOL;
    }

    private function countAntinodes(array $typedMap, mixed $type)
    {
        $locations = [];
        foreach ($typedMap as $i => $row) {
            foreach ($row as $j => $cell) {
                if ($cell === $type) {
                    $locations[] = [$i, $j];
                }
            }
        }

        $antinodelocations = [];
        foreach ($locations as $location) {
            foreach ($locations as $location2) {
                if ($location !== $location2) {
                    $antinodelocations[] = $this->getAntinodeLocation($location, $location2);
                }

            }
        }

        return array_flip(array_map(
            fn ($item) => "{$item[0]}-{$item[1]}",
            array_filter(
                $antinodelocations,
                fn ($location) => $location[0] >= 0 && $location[1] >= 0 &&
                    $location[0] < count($typedMap) && $location[1] < count($typedMap[0])
            )
        ));
    }

    private function getAntinodeLocation(mixed $location, mixed $location2)
    {
        $antinodeLocation[0] = 2 * $location[0] - $location2[0];
        $antinodeLocation[1] = 2 * $location[1] - $location2[1];

        return $antinodeLocation;
    }

    private function countAntinodesWithSameLocation(array $typedMap, mixed $type)
    {
        $locations = [];
        foreach ($typedMap as $i => $row) {
            foreach ($row as $j => $cell) {
                if ($cell === $type) {
                    $locations[] = [$i, $j];
                }
            }
        }

        $antinodeLocations = [];
        foreach ($locations as $location) {
            foreach ($locations as $location2) {
                if ($location !== $location2) {
                    $antinodeLocations = array_merge(
                        $antinodeLocations,
                        $this->getAntinodeLocationRepeated($location, $location2, $typedMap)
                    );
                }

            }
        }


        return array_flip(array_map(
            fn ($item) => "{$item[0]}-{$item[1]}",
            array_filter(
                $antinodeLocations,
                fn ($location) => $location[0] >= 0 && $location[1] >= 0 &&
                    $location[0] < count($typedMap) && $location[1] < count($typedMap[0])
            )
        ));
    }

    private function getAntinodeLocationRepeated(mixed $location, mixed $location2, array $typedMap)
    {
        $dy = $location[0] - $location2[0];
        $dx = $location[1] - $location2[1];

        $y = $location[0];
        $x = $location[1];

        $locations = [];
        while ($x >= 0 && $y >= 0 && $y < count($typedMap) && $x < count($typedMap[0])) {
            $locations[] = [$y, $x];
            $y -= $dy;
            $x -= $dx;
        }

        $y = $location[0] + $dy;
        $x = $location[1] + $dx;

        while ($x >= 0 && $y >= 0 && $y < count($typedMap) && $x < count($typedMap[0])) {
            $locations[] = [$y, $x];
            $y += $dy;
            $x += $dx;
        }

        return $locations;
    }
}
