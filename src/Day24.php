<?php

namespace Robertogallea\AdventOfCode2024;

class Day24
{
    public function solveFirstPart(string $input): int
    {
        [$signals, $gates] = $this->parseInput($input);

        $signals = $this->simulate($gates, $signals);

        ksort($signals);
        $signals = array_reverse($signals, true);
        $signals = array_filter($signals, fn ($key) => $key[0] === 'z', ARRAY_FILTER_USE_KEY);

        return bindec(implode('', $signals));
    }


    public function solveSecondPart(string $input): string
    {
        [$signals, $gates] = $this->parseInput($input);

        $candidates = [];

        foreach ($gates as $gateKey => $gate) {

            // output is z, operation must be XOR unless last bit
            if (($gateKey[0] === 'z') && ($gate['type'] !== 'XOR') && ($gateKey !== 'z45')) {
                $candidates[] = $gateKey;
            }

            // output is NOT z and inputs are not x and y, operation must be AND or OR
            if (
                ($gateKey[0] !== 'z') &&
                $gate['in1'][0] !== 'x' && $gate['in1'][0] !== 'y' && $gate['in2'][0] !== 'x' && $gate['in2'][0] !== 'y' &&
                $gate['type'] === 'XOR'
            ) {
                $candidates[] = $gateKey;
            }

            // XOR gate with x and y input, there must exist a XOR with this gate as input
            if (
                ($gate['type'] === 'XOR') &&
                (
                    ($gate['in1'][0] == 'x') && ($gate['in2'][0] == 'y') ||
                    ($gate['in1'][0] == 'y') && ($gate['in2'][0] == 'x')
                ) &&
                ($gate['in1'] !== 'x00') && ($gate['in1'] !== 'y00') && ($gate['in2'] !== 'x00') && ($gate['in2'] !== 'y00')
            ) {
                $found = false;
                foreach ($gates as $connectedGate) {
                    if (
                        ($connectedGate['type'] === 'XOR') &&
                        (($connectedGate['in1'] === $gateKey) || ($connectedGate['in2'] === $gateKey))
                    ) {
                        $found = true;
                        break;
                    }
                }
                if (!$found) {
                    $candidates[] = $gateKey;
                }
            }

            // AND gate with x and y input, there must exist an OR with this gate as input
            if (
                ($gate['type'] === 'AND') &&
                (
                    ($gate['in1'][0] == 'x') && ($gate['in2'][0] == 'y') ||
                    ($gate['in1'][0] == 'y') && ($gate['in2'][0] == 'x')
                ) &&
                ($gate['in1'] !== 'x00') && ($gate['in1'] !== 'y00') && ($gate['in2'] !== 'x00') && ($gate['in2'] !== 'y00')
            ) {
                $found = false;
                foreach ($gates as $connectedGate) {
                    if (
                        ($connectedGate['type'] === 'OR') &&
                        (($connectedGate['in1'] === $gateKey) || ($connectedGate['in2'] === $gateKey))
                    ) {
                        $found = true;
                        break;
                    }
                }
                if (!$found) {
                    $candidates[] = $gateKey;
                }
            }

            $candidates = array_unique($candidates);
        }

        sort($candidates);

        return implode(',', $candidates);

    }


    private function parseInput(string $input): array
    {
        [$_signals, $_gates] = explode(PHP_EOL.PHP_EOL, $input, 2);

        $signals = [];
        $gates = [];
        foreach (explode(PHP_EOL, $_signals) as $signal) {
            [$name, $value] = explode(': ', $signal);
            $signals[$name] = $value;
        }

        foreach (explode(PHP_EOL, $_gates) as $gate) {
            [$config, $out] = explode(' -> ', $gate);
            [$in1, $type, $in2] = explode(' ', $config, 3);
            $gates[$out] = [
                'in1' => $in1,
                'in2' => $in2,
                'type' => $type,
            ];
        }

        return [$signals, $gates];
    }

    public function simulate(array $gates, array $signals): ?array
    {
        while (!empty($gates)) {
            $changed = false;
            foreach ($gates as $out => $gate) {
                if (array_key_exists($gate['in1'], $signals) && array_key_exists($gate['in2'], $signals)) {
                    $signals[$out] = match ($gate['type']) {
                        'AND' => $signals[$gate['in1']] & $signals[$gate['in2']],
                        'OR' => $signals[$gate['in1']] | $signals[$gate['in2']],
                        'XOR' => (int) ($signals[$gate['in1']] != $signals[$gate['in2']]),
                    };
                    $changed = true;
                    unset($gates[$out]);
                    break;
                }
            }
            if (!$changed) {
                return null;
            }

        }
        return $signals;
    }

}
