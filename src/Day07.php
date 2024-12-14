<?php

namespace Robertogallea\AdventOfCode2024;

class Day07
{
    public function solveFirstPart(string $input): int
    {
        $input = $this->parseInput($input);

        $result = 0;
        foreach ($input as [$solution, $numbers]) {

            $firstElement = array_shift($numbers);

            $leftResult = $this->checkSolution($solution, $numbers, $firstElement, Operation::MULTIPLY);
            $rightResult = $this->checkSolution($solution, $numbers, $firstElement, Operation::SUM);

            if ($leftResult || $rightResult) {
                $result += $solution;
            }
        }

        return $result;
    }

    public function solveSecondPart(string $input): int
    {
        $input = $this->parseInput($input);

        $result = 0;
        foreach ($input as [$solution, $numbers]) {

            $accepted = static::checkSolutionPart2($solution, $numbers);

            if ($accepted) {
                $result += $solution;
            }
        }

        return $result;
    }

    public function checkSolution(int $solution, array $input, int $partialResult, Operation $operation): bool
    {
        if (count($input) === 0) {
            return ($solution === $partialResult);
        }

        if ($partialResult > $solution) {
            return false;
        }

        $firstElement = array_shift($input);

        $result = match ($operation) {
            Operation::MULTIPLY => $partialResult * $firstElement,
            Operation::SUM => $partialResult + $firstElement
        };

        $leftResult = $this->checkSolution($solution, $input, $result, Operation::MULTIPLY);
        $rightResult = $this->checkSolution($solution, $input, $result, Operation::SUM);

        return $leftResult || $rightResult;
    }

    public function checkSolutionPart2(int $solution, array $input, int $partialResult = null): bool
    {
        if (count($input) === 0) {
            return ($solution === $partialResult);
        }

        if ($partialResult > $solution) {
            return false;
        }

        $firstElement = array_shift($input);
        $rightResult = false;
        $midResult = false;

        $leftResult = $this->checkSolutionPart2($solution, $input, ($partialResult ?? 1) * $firstElement);

        if (!$leftResult) {
            $rightResult = $this->checkSolutionPart2($solution, $input, ($partialResult ?? 0) + $firstElement);
        }

        if (!$rightResult) {
            $midResult = $this->checkSolutionPart2($solution, $input, ($partialResult ?? '') . $firstElement);
        }

        return $leftResult || $rightResult || $midResult;
    }

    /**
     * @param string $line
     * @return array<{int, array}>
     */
    public static function normalizeInput(string $line): array
    {
        [$solution, $rawNumbers] = explode(': ', $line);

        $solution = (int)$solution;

        $numbers = array_map(
            static fn (string $number): int => (int)$number,
            explode(' ', $rawNumbers)
        );

        return [$solution, $numbers];
    }


    private function parseInput($list): array
    {
        return array_map(
            function ($row) {
                $parts = explode(':', $row);
                return [$parts[0], array_filter(explode(' ', $parts[1]))];
            },
            explode("\n", $list)
        );
    }
}


enum Operation
{
    case MULTIPLY;
    case SUM;
}
