<?php

namespace Robertogallea\AdventOfCode2024;

class Day25
{
    public function solveFirstPart(string $input): int
    {
        [$locks, $keys] = $this->parseInput($input);

        $result = 0;

        foreach ($locks as $lock) {
            foreach ($keys as $key) {
                if ($this->tryWith($lock, $key)) {
                    $result++;
                }
            }
        }

        return $result;
    }


    public function solveSecondPart(string $input): int
    {

        return -1;
    }

    private function parseInput(string $input)
    {
        $schematics = explode(PHP_EOL.PHP_EOL, $input);

        $schematics = array_map(fn ($schematic) => explode(PHP_EOL, $schematic), $schematics);

        $locks = array_filter($schematics, fn ($schematic) => $schematic[0] === '#####' && end($schematic) === '.....');
        $keys = array_filter($schematics, fn ($schematic) => $schematic[0] === '.....' && end($schematic) === '#####');

        $locksHeights = [];
        foreach ($locks as $lock) {
            $heights = array_fill(0, strlen($lock[0]), 0);
            foreach ($lock as $i => $row) {
                if (($i != 0) && ($i != sizeof($lock) - 1)) {
                    foreach (str_split($row) as $j => $value) {
                        if ($value === '#') {
                            $heights[$j]++;
                        }
                    }
                }
            }
            $locksHeights[] = $heights;
        }

        $keysHeights = [];
        foreach ($keys as $key) {
            $heights = array_fill(0, strlen($key[0]), 0);
            foreach ($key as $i => $row) {
                if (($i != 0) && ($i != sizeof($key) - 1)) {
                    foreach (str_split($row) as $j => $value) {
                        if ($value === '#') {
                            $heights[$j]++;
                        }
                    }
                }
            }
            $keysHeights[] = $heights;
        }

        return [$locksHeights, $keysHeights];
    }

    private function tryWith(array $lock, array $key)
    {
        for ($i = 0; $i < sizeof($lock); $i++) {
            if ($lock[$i] + $key[$i] >= 6) {
                return false;
            }
        }

        return true;
    }

}
