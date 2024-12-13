<?php

namespace Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Robertogallea\AdventOfCode2024\Day10;
use Robertogallea\AdventOfCode2024\Day11;
use Robertogallea\AdventOfCode2024\Day12;

class Day12Test extends TestCase
{
    #[Test]
    #[DataProvider('part1List')]
    public function it_works_with_part1($list, $expectedResult)
    {

        $puzzle = new Day12();
        $result = $puzzle->solveFirstPart($list);

        $this->assertEquals($expectedResult, $result);
    }

    public static function part1List()
    {
        return [
            yield 'simple example' => [
                "AAAA".PHP_EOL.
                "BBCD".PHP_EOL.
                "BBCC".PHP_EOL.
                "EEEC", 140
            ],
            yield 'simple example 2' => [
                "OOOOO".PHP_EOL.
                "OXOXO".PHP_EOL.
                "OOOOO".PHP_EOL.
                "OXOXO".PHP_EOL.
                "OOOOO", 772
            ],
            yield 'simple example 3' => [
                "RRRRIICCFF".PHP_EOL.
                "RRRRIICCCF".PHP_EOL.
                "VVRRRCCFFF".PHP_EOL.
                "VVRCCCJFFF".PHP_EOL.
                "VVVVCJJCFE".PHP_EOL.
                "VVIVCCJJEE".PHP_EOL.
                "VVIIICJJEE".PHP_EOL.
                "MIIIIIJJEE".PHP_EOL.
                "MIIISIJEEE".PHP_EOL.
                "MMMISSJEEE", 1930
            ],
            yield 'actual input' => [file_get_contents(__DIR__."/Data/Day12/part1.txt"), 1377008]
        ];
    }

    #[Test]
    #[DataProvider('part2List')]
    public function it_works_with_part2($list, $expectedResult)
    {

        $puzzle = new Day12();
        $result = $puzzle->solveSecondPart($list);

        $this->assertEquals($expectedResult, $result);
    }

    public static function part2List()
    {
        return [
            yield 'simple example' => [
                "AAAA".PHP_EOL.
                "BBCD".PHP_EOL.
                "BBCC".PHP_EOL.
                "EEEC", 80
            ],
            yield 'simple example 2' => [
                "OOOOO".PHP_EOL.
                "OXOXO".PHP_EOL.
                "OOOOO".PHP_EOL.
                "OXOXO".PHP_EOL.
                "OOOOO", 436
            ],
            yield 'simple example 3' => [
                "EEEEE".PHP_EOL.
                "EXXXX".PHP_EOL.
                "EEEEE".PHP_EOL.
                "EXXXX".PHP_EOL.
                "EEEEE", 236
            ],
            yield 'simple example 4' => [
                "AAAAAA".PHP_EOL.
                "AAABBA".PHP_EOL.
                "AAABBA".PHP_EOL.
                "ABBAAA".PHP_EOL.
                "ABBAAA".PHP_EOL.
                "AAAAAA", 368
            ],
            yield 'simple example 5' => [
                "RRRRIICCFF".PHP_EOL.
                "RRRRIICCCF".PHP_EOL.
                "VVRRRCCFFF".PHP_EOL.
                "VVRCCCJFFF".PHP_EOL.
                "VVVVCJJCFE".PHP_EOL.
                "VVIVCCJJEE".PHP_EOL.
                "VVIIICJJEE".PHP_EOL.
                "MIIIIIJJEE".PHP_EOL.
                "MIIISIJEEE".PHP_EOL.
                "MMMISSJEEE", 1206
            ],
            yield 'actual input' => [file_get_contents(__DIR__."/Data/Day12/part2.txt"), 815788]
        ];
    }

}
