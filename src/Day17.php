<?php

namespace Robertogallea\AdventOfCode2024;

class Day17
{
    public function solveFirstPart(string $input): string
    {
        [$registers, $program] = $this->parseInput($input);

        $output = $this->execute($registers, $program);

        return implode(',', $output);
    }

    public function solveSecondPart(string $input): int
    {
        [$registers, $program] = $this->parseInput($input);
        $i = $this->findQuine(0, 1, $registers, $program);

        return $i;
    }


    private function parseInput(string $input)
    {
        [$registers, $program] = explode(PHP_EOL.PHP_EOL, $input);
        $registers = array_map(fn ($register) => intval(explode(': ', $register)[1]), explode(PHP_EOL, $registers));
        $program = array_map(fn ($item) => intval($item), explode(',', explode(': ', $program)[1]));

        return [$registers, $program];
    }

    private function execute(
        array $registers,
        array $instructions
    ): array {
        $output = [];
        for ($i = 0; $i < count($instructions); $i += 2) {
            $opCode = $instructions[$i];
            $operand = $instructions[$i + 1];

            $comboOperand = match (true) {
                $operand < 4 => $operand,
                $operand == 4 => $registers[0],
                $operand == 5 => $registers[1],
                $operand == 6 => $registers[2],
                default => die()
            };

            switch ($opCode) {
                case Instruction::ADV->value:
                    $registers[0] = intdiv($registers[0], 1 << $comboOperand);
                    break;
                case Instruction::BXL->value:
                    $registers[1] ^= $operand;
                    break;
                case Instruction::BST->value:
                    $registers[1] = $comboOperand % 8;
                    break;
                case Instruction::JNZ->value:
                    if ($registers[0]) {
                        $i = $operand - 2;
                    }
                    break;
                case Instruction::BXC->value:
                    $registers[1] ^= $registers[2];
                    break;
                case Instruction::OUT->value:
                    $output[] = $comboOperand % 8;
                    break;
                case Instruction::BDV->value:
                    $registers[1] = intdiv($registers[0], 1 << $comboOperand);
                    break;
                case Instruction::CDV->value:
                    $registers[2] = intdiv($registers[0], 1 << $comboOperand);
                    break;
            }
        }

        return $output;
    }

    private function findQuine(int $a, int $n, array $registers, array $instructions)
    {
        $programSize = count($instructions);
        if ($n > $programSize) {
            return $a;
        }
        for ($i = 0; $i < 8; $i++) {
            $newRegisters = $registers;
            $newRegisters[0] = $a * 8 + $i;
            if ($this->isQuine($n, $newRegisters, $instructions)) {
                $result = $this->findQuine($a * 8 + $i, $n + 1, $registers, $instructions);
                if ($result != -1) {
                    return $result;
                }
            }
        }
        return -1;
    }

    private function isQuine(
        int $number,
        array $registers,
        array $instructions
    ): bool {
        $numOutput = 0;

        for ($i = 0; $i < count($instructions); $i += 2) {
            $opCode = $instructions[$i];
            $operand = $instructions[$i + 1];

            $comboOperand = match (true) {
                $operand < 4 => $operand,
                $operand == 4 => $registers[0],
                $operand == 5 => $registers[1],
                $operand == 6 => $registers[2],
                default => die()
            };

            switch ($opCode) {
                case Instruction::ADV->value:
                    $registers[0] = intdiv($registers[0], 1 << $comboOperand);
                    break;
                case Instruction::BXL->value:
                    $registers[1] ^= $operand;
                    break;
                case Instruction::BST->value:
                    $registers[1] = $comboOperand % 8;
                    break;
                case Instruction::JNZ->value:
                    if ($registers[0]) {
                        $i = $operand - 2;
                    }
                    break;
                case Instruction::BXC->value:
                    $registers[1] ^= $registers[2];
                    break;
                case Instruction::OUT->value:
                    $out = $comboOperand % 8;
                    if ($instructions[count($instructions) - $number + $numOutput] != $out) {
                        return false;
                    }
                    $numOutput++;
                    if ($numOutput == $number) {
                        return true;
                    }
                    break;
                case Instruction::BDV->value:
                    $registers[1] = intdiv($registers[0], 1 << $comboOperand);
                    break;
                case Instruction::CDV->value:
                    $registers[2] = intdiv($registers[0], 1 << $comboOperand);
                    break;
            }
        }

        return false;
    }
}

enum Instruction: int
{
    case ADV = 0;
    case BXL = 1;
    case BST = 2;
    case JNZ = 3;
    case BXC = 4;
    case OUT = 5;
    case BDV = 6;
    case CDV = 7;
}
