<?php

namespace Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Robertogallea\AdventOfCode2024\Day17;
use Robertogallea\AdventOfCode2024\Day18;

class Day18Test extends TestCase
{
    #[Test]
    #[DataProvider('part1List')]
    public function it_works_with_part1($list, $gridSize, $nBytes, $expectedResult)
    {
        $puzzle = new Day18();

        $result = $puzzle->solveFirstPart($list, $gridSize, $nBytes);

        $this->assertEquals($expectedResult, $result);
    }

    public static function part1List()
    {
        return [
            yield 'simple example' => [
                "5,4".PHP_EOL.
                "4,2".PHP_EOL.
                "4,5".PHP_EOL.
                "3,0".PHP_EOL.
                "2,1".PHP_EOL.
                "6,3".PHP_EOL.
                "2,4".PHP_EOL.
                "1,5".PHP_EOL.
                "0,6".PHP_EOL.
                "3,3".PHP_EOL.
                "2,6".PHP_EOL.
                "5,1".PHP_EOL.
                "1,2".PHP_EOL.
                "5,5".PHP_EOL.
                "2,5".PHP_EOL.
                "6,5".PHP_EOL.
                "1,4".PHP_EOL.
                "0,4".PHP_EOL.
                "6,4".PHP_EOL.
                "1,1".PHP_EOL.
                "6,1".PHP_EOL.
                "1,0".PHP_EOL.
                "0,5".PHP_EOL.
                "1,6".PHP_EOL.
                "2,0", 7, 12, 22
            ],
            yield 'actual input' => [file_get_contents(__DIR__."/Data/Day18/part1.txt"), 71, 1024, 374]
        ];
    }

    #[Test]
    #[DataProvider('part2List')]
    public function it_works_with_part2($list, $gridSize, $expectedResult)
    {

        $puzzle = new Day18();
        $result = $puzzle->solveSecondPart($list, $gridSize);

        $this->assertEquals($expectedResult, $result);
    }

    public static function part2List()
    {
        return [
            yield 'simple example' => [
                "5,4".PHP_EOL.
                "4,2".PHP_EOL.
                "4,5".PHP_EOL.
                "3,0".PHP_EOL.
                "2,1".PHP_EOL.
                "6,3".PHP_EOL.
                "2,4".PHP_EOL.
                "1,5".PHP_EOL.
                "0,6".PHP_EOL.
                "3,3".PHP_EOL.
                "2,6".PHP_EOL.
                "5,1".PHP_EOL.
                "1,2".PHP_EOL.
                "5,5".PHP_EOL.
                "2,5".PHP_EOL.
                "6,5".PHP_EOL.
                "1,4".PHP_EOL.
                "0,4".PHP_EOL.
                "6,4".PHP_EOL.
                "1,1".PHP_EOL.
                "6,1".PHP_EOL.
                "1,0".PHP_EOL.
                "0,5".PHP_EOL.
                "1,6".PHP_EOL.
                "2,0", 7, '6,1'
            ],
            yield 'actual input' => [file_get_contents(__DIR__."/Data/Day18/part1.txt"), 71, '30,12',]
        ];
    }

}