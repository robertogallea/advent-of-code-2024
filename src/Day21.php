<?php

namespace Robertogallea\AdventOfCode2024;

class Day21
{
    private const POSITIONS = [
        '7' => [0, 0], '8' => [0, 1], '9' => [0, 2],
        '4' => [1, 0], '5' => [1, 1], '6' => [1, 2],
        '1' => [2, 0], '2' => [2, 1], '3' => [2, 2],
        '0' => [3, 1], 'A' => [3, 2], '^' => [0, 1],
        'a' => [0, 2], '<' => [1, 0], 'v' => [1, 1],
        '>' => [1, 2],
    ];

    private const DIRECTIONS = [
        '^' => [-1, 0], 'v' => [1, 0], '<' => [0, -1], '>' => [0, 1],
    ];

    private array $cache = [];

    public function solveFirstPart(string $input): int
    {
        $codes = $this->parseInput($input);
        return $this->calculateComplexity($codes, 2);
    }

    public function solveSecondPart(string $input): int
    {
        $codes = $this->parseInput($input);
        return $this->calculateComplexity($codes, 25);
    }

    private function calculateComplexity(array $data, int $limit): int
    {
        return array_reduce($data, function (int $sum, string $code) use ($limit): int {
            $numeric = (int) substr($code, 0, 3);
            return $sum + $numeric * $this->minSequenceLength($code, $limit);
        }, 0);
    }

    private function minSequenceLength(string $code, int $limit, int $depth = 0): int
    {
        $cacheKey = "{$code}-{$depth}-{$limit}";

        if (isset($this->cache[$cacheKey])) {
            return $this->cache[$cacheKey];
        }

        $avoid = $depth === 0 ? [3, 0] : [0, 0];
        $currentPos = $depth === 0 ? self::POSITIONS['A'] : self::POSITIONS['a'];
        $length = 0;

        foreach (str_split($code) as $char) {
            $nextPos = self::POSITIONS[$char];
            $moves = $this->findMoves($currentPos, $nextPos, $avoid);

            $length += ($depth === $limit)
                ? strlen($moves[0])
                : min(array_map(fn ($move) => $this->minSequenceLength($move, $limit, $depth + 1), $moves));

            $currentPos = $nextPos;
        }

        return $this->cache[$cacheKey] = $length;
    }

    private function findMoves(array $start, array $end, array $avoid = [0, 0]): array
    {
        $delta = [$end[0] - $start[0], $end[1] - $start[1]];
        $sequence = str_repeat($delta[0] < 0 ? '^' : 'v', abs($delta[0]))
            .str_repeat($delta[1] < 0 ? '<' : '>', abs($delta[1]));

        $combinations = $this->generateCombinations(str_split($sequence));
        $validMoves = [];

        foreach ($combinations as $combo) {
            $positions = [$start];
            foreach ($combo as $dir) {
                $lastPos = end($positions);
                $positions[] = [$lastPos[0] + self::DIRECTIONS[$dir][0], $lastPos[1] + self::DIRECTIONS[$dir][1]];
            }

            if (!in_array($avoid, $positions, true)) {
                $validMoves[] = implode('', $combo).'a';
            }
        }

        return $validMoves ?: ['a'];
    }

    private function generateCombinations(array $items): array
    {
        if (count($items) === 1) {
            return [$items];
        }

        $result = [];
        foreach ($items as $index => $item) {
            $remaining = $items;
            unset($remaining[$index]);

            foreach ($this->generateCombinations($remaining) as $combo) {
                $result[] = array_merge([$item], $combo);
            }
        }

        return $result;
    }

    private function parseInput(string $input): array
    {
        return array_values(array_filter(explode("\n", trim($input)), fn ($line) => preg_match('/\d{3}A/', $line)));
    }
}
