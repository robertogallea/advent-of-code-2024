<?php

namespace Robertogallea\AdventOfCode2024;

class Day19
{
    private array $cache = [];

    public function solveFirstPart(string $input): string
    {
        [$availableTowels, $wantedTowels] = $this->parseInput($input);

        $arranged = 0;

        foreach ($wantedTowels as $wantedTowel) {
            if ($this->towelCanBeArrangedWithOptions($wantedTowel, $availableTowels) > 0) {
                $arranged++;
            }
        }

        return $arranged;
    }

    public function solveSecondPart(string $input): string
    {

        [$availableTowels, $wantedTowels] = $this->parseInput($input);

        $arrangingOptions = 0;

        foreach ($wantedTowels as $wantedTowel) {
            if (($options = $this->towelCanBeArrangedWithOptions($wantedTowel, $availableTowels)) > -1) {
                $arrangingOptions += $options;
            }
        }

        return $arrangingOptions;
    }

    private function parseInput(string $input): array
    {
        $parts = explode(PHP_EOL.PHP_EOL, $input);

        return [
            explode(', ', $parts[0]),
            explode(PHP_EOL, $parts[1])
        ];
    }

    private function towelCanBeArrangedWithOptions(
        string $wantedTowel,
        array $availableTowels
    ): int {

        if ($wantedTowel === '') {
            return 1;
        }

        if (array_key_exists($wantedTowel, $this->cache)) {
            return $this->cache[$wantedTowel];
        }

        $options = 0;

        foreach ($availableTowels as $availableTowel) {
            if (str_starts_with($wantedTowel, $availableTowel)) {
                $remainingTowel = substr($wantedTowel, strlen($availableTowel));

                $options += $this->towelCanBeArrangedWithOptions($remainingTowel, $availableTowels);
            }
        }

        return $this->cache[$wantedTowel] = $options; // Cache and return total ways
    }
}
