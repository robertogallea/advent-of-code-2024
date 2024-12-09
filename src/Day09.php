<?php

namespace Robertogallea\AdventOfCode2024;

class Day09
{
    public function solveFirstPart(string $input): int
    {
        $array = str_split($input);
        $map = $this->createMap($array);

        $lastFilledBlockId = count($map) - 1;

        $checksum = 0;

        for ($i = 0; $i < count($map); $i++) {
            if ($i > $lastFilledBlockId) {
                break;
            }
            if ($map[$i] === '.') {
                $map[$i] = $map[$lastFilledBlockId];
                $map[$lastFilledBlockId] = '.';

                while ($map[$lastFilledBlockId] === '.') {
                    $lastFilledBlockId--;
                }
//                $this->dump($map);
            }
            $checksum += $map[$i] * $i;
        }

        return $checksum;
    }

    public function solveSecondPart(string $input): int
    {
        $array = str_split($input);
        [
            $map, $emptyBlockSizes, $filledBlockSizes, $emptyBlockStarts, $filledBlockStarts
        ] = $this->createMapWithInfo($array);

        $maxId = max($map);

        $idMoved = array_fill(0, $maxId, false);

        for ($j = $maxId; $j >= 0; $j--) { // for each block
            for ($i = 0; $i < $j; $i++) { // for each empty space before the current block
                if ($emptyBlockSizes[$i] >= $filledBlockSizes[$j]) {
                    // move block
                    $emptyBlockSizes[$i] -= $filledBlockSizes[$j];
                    for ($k = 0; $k < $filledBlockSizes[$j]; $k++) {
                        $map[$k+$emptyBlockStarts[$i]] = $j;
                        $map[$k+$filledBlockStarts[$j]] = '.';
                    }
                    $emptyBlockStarts[$i] += $filledBlockSizes[$j];
                    break;
                }
            }
        }

        $checksum = 0;

        for ($i = 0; $i < count($map); $i++) {
            if ($map[$i] !== '.') {
                $checksum += $map[$i] * $i;
            }
        }

        return $checksum;
    }

    public function dump($disk)
    {
        echo implode('', $disk).PHP_EOL;
    }

    public function createMap(array $array): array
    {
        [
            $map, $emptyBlockSizes, $filledBlockSizes, $emptyBlockStarts, $filledBlockStarts
        ] = $this->createMapWithInfo($array);

        return $map;
    }

    public function createMapWithInfo(array $array): array
    {
        $currentId = 0;
        $nextBlockStart = 0;
        $map = [];
        for ($i = 0; $i < count($array); $i++) {
            if ($i % 2) { // empty block
                $map = array_merge($map, array_fill(0, $array[$i], '.'));
                $emptyBlockSizes[] = $array[$i];
                $emptyBlockStarts[] = $nextBlockStart;
            } else { // filled block
                $map = array_merge($map, array_fill(0, $array[$i], $currentId));
                $filledBlockSizes[] = $array[$i];
                $filledBlockStarts[] = $nextBlockStart;
                $currentId++;
            }
            $nextBlockStart += $array[$i];
        }
        return [$map, $emptyBlockSizes, $filledBlockSizes, $emptyBlockStarts, $filledBlockStarts];
    }
}