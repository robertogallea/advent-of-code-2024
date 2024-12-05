<?php

namespace Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Robertogallea\AdventOfCode2024\Day04;

class Day04Test extends TestCase
{
    #[Test]
    #[DataProvider('part1List')]
    public function it_works_with_part1($list, $expectedResult)
    {

        $puzzle = new Day04();
        $result = $puzzle->solveFirstPart($list);

        $this->assertEquals($expectedResult, $result);
    }

    public static function part1List()
    {
        return [
            yield 'example' => [
                "MMMSXXMASM".PHP_EOL.
                "MSAMXMSMSA".PHP_EOL.
                "AMXSXMAAMM".PHP_EOL.
                "MSAMASMSMX".PHP_EOL.
                "XMASAMXAMM".PHP_EOL.
                "XXAMMXXAMA".PHP_EOL.
                "SMSMSASXSS".PHP_EOL.
                "SAXAMASAAA".PHP_EOL.
                "MAMMMXMMMM".PHP_EOL.
                "MXMXAXMASX", 18
            ],
            yield 'actual input' => [file_get_contents(__DIR__."/Data/Day04/part1.txt"), 2547]
        ];
    }

    #[Test]
    #[DataProvider('part2List')]
    public function it_works_with_part2($list, $expectedResult)
    {

        $puzzle = new Day04();
        $result = $puzzle->solveSecondPart($list);

        $this->assertEquals($expectedResult, $result);
    }

    public static function part2List()
    {
        return [
            yield 'example' => [
                "MMMSXXMASM".PHP_EOL.
                "MSAMXMSMSA".PHP_EOL.
                "AMXSXMAAMM".PHP_EOL.
                "MSAMASMSMX".PHP_EOL.
                "XMASAMXAMM".PHP_EOL.
                "XXAMMXXAMA".PHP_EOL.
                "SMSMSASXSS".PHP_EOL.
                "SAXAMASAAA".PHP_EOL.
                "MAMMMXMMMM".PHP_EOL.
                "MXMXAXMASX", 9
            ],
            yield 'actual input' => [file_get_contents(__DIR__."/Data/Day04/part2.txt"), 1939]
        ];
    }

}
