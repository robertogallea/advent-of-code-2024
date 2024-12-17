<?php

namespace Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Robertogallea\AdventOfCode2024\Day16;
use Robertogallea\AdventOfCode2024\Direction;

class Day16Test extends TestCase
{
    #[Test]
    #[DataProvider('part1List')]
    public function it_works_with_part1($list, $expectedResult)
    {
        $puzzle = new Day16();

        $result = $puzzle->solveFirstPart($list);

        $this->assertEquals($expectedResult, $result);
    }

    public static function part1List()
    {
        return [
            yield 'simple example' => [
                "###############".PHP_EOL.
                "#.......#....E#".PHP_EOL.
                "#.#.###.#.###.#".PHP_EOL.
                "#.....#.#...#.#".PHP_EOL.
                "#.###.#####.#.#".PHP_EOL.
                "#.#.#.......#.#".PHP_EOL.
                "#.#.#####.###.#".PHP_EOL.
                "#...........#.#".PHP_EOL.
                "###.#.#####.#.#".PHP_EOL.
                "#...#.....#.#.#".PHP_EOL.
                "#.#.#.###.#.#.#".PHP_EOL.
                "#.....#...#.#.#".PHP_EOL.
                "#.###.#.#.#.#.#".PHP_EOL.
                "#S..#.....#...#".PHP_EOL.
                "###############", 7036
            ],
            yield 'simple example 2' => [
                "#################".PHP_EOL.
                "#...#...#...#..E#".PHP_EOL.
                "#.#.#.#.#.#.#.#.#".PHP_EOL.
                "#.#.#.#...#...#.#".PHP_EOL.
                "#.#.#.#.###.#.#.#".PHP_EOL.
                "#...#.#.#.....#.#".PHP_EOL.
                "#.#.#.#.#.#####.#".PHP_EOL.
                "#.#...#.#.#.....#".PHP_EOL.
                "#.#.#####.#.###.#".PHP_EOL.
                "#.#.#.......#...#".PHP_EOL.
                "#.#.###.#####.###".PHP_EOL.
                "#.#.#...#.....#.#".PHP_EOL.
                "#.#.#.#####.###.#".PHP_EOL.
                "#.#.#.........#.#".PHP_EOL.
                "#.#.#.#########.#".PHP_EOL.
                "#S#.............#".PHP_EOL.
                "#################", 11048
            ],
            yield 'actual input' => [file_get_contents(__DIR__."/Data/Day16/part1.txt"), 75416]
        ];
    }

    #[Test]
    #[DataProvider('part2List')]
    public function it_works_with_part2($list, $expectedResult)
    {

        $puzzle = new Day16();
        $result = $puzzle->solveSecondPart($list);

        $this->assertEquals($expectedResult, $result);
    }

    public static function part2List()
    {
        return [
            yield 'simple example' => [
                "###############".PHP_EOL.
                "#.......#....E#".PHP_EOL.
                "#.#.###.#.###.#".PHP_EOL.
                "#.....#.#...#.#".PHP_EOL.
                "#.###.#####.#.#".PHP_EOL.
                "#.#.#.......#.#".PHP_EOL.
                "#.#.#####.###.#".PHP_EOL.
                "#...........#.#".PHP_EOL.
                "###.#.#####.#.#".PHP_EOL.
                "#...#.....#.#.#".PHP_EOL.
                "#.#.#.###.#.#.#".PHP_EOL.
                "#.....#...#.#.#".PHP_EOL.
                "#.###.#.#.#.#.#".PHP_EOL.
                "#S..#.....#...#".PHP_EOL.
                "###############", 45
            ],
            yield 'simple example 2' => [
                "#################".PHP_EOL.
                "#...#...#...#..E#".PHP_EOL.
                "#.#.#.#.#.#.#.#.#".PHP_EOL.
                "#.#.#.#...#...#.#".PHP_EOL.
                "#.#.#.#.###.#.#.#".PHP_EOL.
                "#...#.#.#.....#.#".PHP_EOL.
                "#.#.#.#.#.#####.#".PHP_EOL.
                "#.#...#.#.#.....#".PHP_EOL.
                "#.#.#####.#.###.#".PHP_EOL.
                "#.#.#.......#...#".PHP_EOL.
                "#.#.###.#####.###".PHP_EOL.
                "#.#.#...#.....#.#".PHP_EOL.
                "#.#.#.#####.###.#".PHP_EOL.
                "#.#.#.........#.#".PHP_EOL.
                "#.#.#.#########.#".PHP_EOL.
                "#S#.............#".PHP_EOL.
                "#################", 64
            ],
            yield 'actual input' => [file_get_contents(__DIR__."/Data/Day16/part2.txt"), 476]
        ];
    }

}