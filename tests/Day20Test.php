<?php

namespace Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Robertogallea\AdventOfCode2024\Day20;

class Day20Test extends TestCase
{
    #[Test]
    #[DataProvider('part1List')]
    public function it_works_with_part1($list, $saving, $expectedResult)
    {
        $puzzle = new Day20();

        $result = $puzzle->solveFirstPart($list, $saving);

        $this->assertEquals($expectedResult, $result);
    }

    public static function part1List()
    {
        return [
            yield 'simple example' => [
                "###############".PHP_EOL.
                "#...#...#.....#".PHP_EOL.
                "#.#.#.#.#.###.#".PHP_EOL.
                "#S#...#.#.#...#".PHP_EOL.
                "#######.#.#.###".PHP_EOL.
                "#######.#.#...#".PHP_EOL.
                "#######.#.###.#".PHP_EOL.
                "###..E#...#...#".PHP_EOL.
                "###.#######.###".PHP_EOL.
                "#...###...#...#".PHP_EOL.
                "#.#####.#.###.#".PHP_EOL.
                "#.#...#.#.#...#".PHP_EOL.
                "#.#.#.#.#.#.###".PHP_EOL.
                "#...#...#...###".PHP_EOL.
                "###############", 2, 44
            ],
            yield 'actual input' => [file_get_contents(__DIR__."/Data/Day20/part1.txt"), 100, 1463]
        ];
    }

    #[Test]
    #[DataProvider('part2List')]
    public function it_works_with_part2($list, $saving, $expectedResult)
    {

        $puzzle = new Day20();
        $result = $puzzle->solveSecondPart($list, $saving);

        $this->assertEquals($expectedResult, $result);
    }

    public static function part2List()
    {
        return [
            yield 'simple example' => [
                "###############".PHP_EOL.
                "#...#...#.....#".PHP_EOL.
                "#.#.#.#.#.###.#".PHP_EOL.
                "#S#...#.#.#...#".PHP_EOL.
                "#######.#.#.###".PHP_EOL.
                "#######.#.#...#".PHP_EOL.
                "#######.#.###.#".PHP_EOL.
                "###..E#...#...#".PHP_EOL.
                "###.#######.###".PHP_EOL.
                "#...###...#...#".PHP_EOL.
                "#.#####.#.###.#".PHP_EOL.
                "#.#...#.#.#...#".PHP_EOL.
                "#.#.#.#.#.#.###".PHP_EOL.
                "#...#...#...###".PHP_EOL.
                "###############", 50, 285
            ],
            yield 'actual input' => [file_get_contents(__DIR__."/Data/Day20/part2.txt"), 100, 985332]
        ];
    }

}