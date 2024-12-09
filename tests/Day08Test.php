<?php

namespace Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Robertogallea\AdventOfCode2024\Day08;

class Day08Test extends TestCase
{
    #[Test]
    #[DataProvider('part1List')]
    public function it_works_with_part1($list, $expectedResult)
    {

        $puzzle = new Day08();
        $result = $puzzle->solveFirstPart($list);

        $this->assertEquals($expectedResult, $result);
    }

    public static function part1List()
    {
        return [
            yield 'example' => [
                "............".PHP_EOL.
                "........0...".PHP_EOL.
                ".....0......".PHP_EOL.
                ".......0....".PHP_EOL.
                "....0.......".PHP_EOL.
                "......A.....".PHP_EOL.
                "............".PHP_EOL.
                "............".PHP_EOL.
                "........A...".PHP_EOL.
                ".........A..".PHP_EOL.
                "............".PHP_EOL.
                "............", 14
            ],
            yield 'actual input' => [file_get_contents(__DIR__."/Data/Day08/part1.txt"), 271]
        ];
    }

    #[Test]
    #[DataProvider('part2List')]
    public function it_works_with_part2($list, $expectedResult)
    {

        $puzzle = new Day08();
        $result = $puzzle->solveSecondPart($list);

        $this->assertEquals($expectedResult, $result);
    }

    public static function part2List()
    {
        return [
            yield 'example' => [
                "............".PHP_EOL.
                "........0...".PHP_EOL.
                ".....0......".PHP_EOL.
                ".......0....".PHP_EOL.
                "....0.......".PHP_EOL.
                "......A.....".PHP_EOL.
                "............".PHP_EOL.
                "............".PHP_EOL.
                "........A...".PHP_EOL.
                ".........A..".PHP_EOL.
                "............".PHP_EOL.
                "............", 34
            ],
            yield 'actual input' => [file_get_contents(__DIR__."/Data/Day08/part2.txt"), 994]
        ];
    }

}
