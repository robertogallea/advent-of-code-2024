<?php

namespace Robertogallea\AdventOfCode2024;

class Day11
{
    protected array $cache = [];

    public function solveFirstPart(string $input, int $blinks): int
    {
        $stones = $this->parseInput($input);

        $total = 0;
        foreach ($stones as $stone) {
            $total += $this->countExpansions($stone, $blinks);
        }

        return $total;
    }

    public function solveSecondPart(string $input, int $blinks): int
    {
        return $this->solveFirstPart($input, $blinks);
    }

    private function countExpansions(int $currentStone, int $blinks)
    {
        $cacheKey = sprintf("%d-%d", $currentStone, $blinks);

        if ($this->cache[$cacheKey]) {
            return $this->cache[$cacheKey];
        }


        if ($blinks == 0) {
            $count = 1;
        } elseif ($currentStone == 0) {
            $count = $this->countExpansions(1, $blinks - 1);
        } else {
            $digits = strlen($currentStone);
            if ($digits % 2 === 0) {
                $leftPart = intdiv($currentStone, pow(10, $digits / 2));
                $rightPart = $currentStone % pow(10, $digits / 2);
                $count =
                    $this->countExpansions($leftPart, $blinks - 1) +
                    $this->countExpansions($rightPart, $blinks - 1);
            } else {
                $count = $this->countExpansions($currentStone * 2024, $blinks - 1);
            }
        }
        $this->cache[$cacheKey] = $count;

        return $count;
    }

    private function parseInput(string $input): array
    {
        return explode(" ", $input);
    }
}
