<?php

namespace Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Robertogallea\AdventOfCode2024\Day06;

class Day06Test extends TestCase
{
    #[Test]
    #[DataProvider('part1List')]
    public function it_works_with_part1($list, $expectedResult)
    {

        $puzzle = new Day06();
        $result = $puzzle->solveFirstPart($list);

        $this->assertEquals($expectedResult, $result);
    }

    public static function part1List()
    {
        return [
            yield 'example' => [
                "....#.....".PHP_EOL.
                ".........#".PHP_EOL.
                "..........".PHP_EOL.
                "..#.......".PHP_EOL.
                ".......#..".PHP_EOL.
                "..........".PHP_EOL.
                ".#..^.....".PHP_EOL.
                "........#.".PHP_EOL.
                "#.........".PHP_EOL.
                "......#...", 41
            ],
            yield 'actual input' => [file_get_contents(__DIR__."/Data/Day06/part1.txt"), 4711]
        ];
    }

    #[Test]
    #[DataProvider('part2List')]
    public function it_works_with_part2($list, $expectedResult)
    {

        $puzzle = new Day06();
        $result = $puzzle->solveSecondPart($list);

        $this->assertEquals($expectedResult, $result);
    }

    public static function part2List()
    {
        return [
            yield 'example' => [
                "....#.....".PHP_EOL.
                ".........#".PHP_EOL.
                "..........".PHP_EOL.
                "..#.......".PHP_EOL.
                ".......#..".PHP_EOL.
                "..........".PHP_EOL.
                ".#..^.....".PHP_EOL.
                "........#.".PHP_EOL.
                "#.........".PHP_EOL.
                "......#...", 6
            ],
            yield 'actual input' => [file_get_contents(__DIR__."/Data/Day06/part2.txt"), 1562]
        ];
    }

}
