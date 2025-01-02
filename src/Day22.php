<?php

namespace Robertogallea\AdventOfCode2024;

class Day22
{
    public function solveFirstPart(string $input): int
    {
        $initialCodes = $this->parseInput($input);
        $result = 0;

        foreach ($initialCodes as $code) {
            $codes = [$code];
            foreach (range(1, 2000) as $iteration) {
                $code = $this->evolve($code);
                $codes[] = $code;
            }
            $result += end($codes);
        }

        return $result;
    }

    public function solveSecondPart(string $input): int
    {
        $initialCodes = $this->parseInput($input);

        foreach ($initialCodes as $code) {
            $codes = [$code];
            foreach (range(1, 2000) as $iteration) {
                $code = $this->evolve($code);
                $codes[] = $code;
            }

            $prices = array_map(fn ($code) => $code % 10, $codes);
            $changes = [];
            for ($i = 0; $i < count($prices) - 1; $i++) {
                $changes[$i] = $prices[$i + 1] - $prices[$i];
            }

            $sequences = [];
            for ($i = 0; $i < count($changes) - 3; $i++) {
                $key = sprintf('%d-%d-%d-%d', $changes[$i], $changes[$i + 1], $changes[$i + 2], $changes[$i + 3]);
                if (!isset($sequences[$key])) {
                    $sequences[$key] = $prices[$i + 4];
                }
            }

            foreach ($sequences as $key => $v) {
                $values[$key] = ($values[$key] ?? 0) + $v;
            }

        }

        return max($values);
    }

    private function parseInput(string $input): array
    {
        return explode("\n", $input);
    }

    private function evolve(int $code): int
    {

        $code = $this->mix($code << 6, $code);
        $code = $this->prune($code);
        $code = $this->mix($code >> 5, $code);
        $code = $this->prune($code);
        $code = $this->mix($code << 11, $code);
        $code = $this->prune($code);

        return $code;
    }

    private function mix(int $code, int $oldCode): int
    {
        return $code ^ $oldCode;
    }

    private function prune(int $code): int
    {
        return $code % 16777216;
    }
}
