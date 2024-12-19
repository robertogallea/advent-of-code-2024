<?php

namespace Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Robertogallea\AdventOfCode2024\Day19;

class Day19Test extends TestCase
{
    #[Test]
    #[DataProvider('part1List')]
    public function it_works_with_part1($list, $expectedResult)
    {
        $puzzle = new Day19();

        $result = $puzzle->solveFirstPart($list);

        $this->assertEquals($expectedResult, $result);
    }

    public static function part1List()
    {
        return [
            yield 'simple example' => [
                "r, wr, b, g, bwu, rb, gb, br".PHP_EOL.
                "".PHP_EOL.
                "brwrr".PHP_EOL.
                "bggr".PHP_EOL.
                "gbbr".PHP_EOL.
                "rrbgbr".PHP_EOL.
                "ubwu".PHP_EOL.
                "bwurrg".PHP_EOL.
                "brgr".PHP_EOL.
                "bbrgwb", 6
            ],
            yield 'actual input' => [file_get_contents(__DIR__."/Data/Day19/part1.txt"), 306]
        ];
    }

    #[Test]
    #[DataProvider('part2List')]
    public function it_works_with_part2($list, $expectedResult)
    {

        $puzzle = new Day19();
        $result = $puzzle->solveSecondPart($list);

        $this->assertEquals($expectedResult, $result);
    }

    public static function part2List()
    {
        return [
            yield 'simple example' => [
                "r, wr, b, g, bwu, rb, gb, br".PHP_EOL.
                "".PHP_EOL.
                "brwrr".PHP_EOL.
                "bggr".PHP_EOL.
                "gbbr".PHP_EOL.
                "rrbgbr".PHP_EOL.
                "ubwu".PHP_EOL.
                "bwurrg".PHP_EOL.
                "brgr".PHP_EOL.
                "bbrgwb", 16
            ],
            yield 'actual input' => [file_get_contents(__DIR__."/Data/Day19/part2.txt"), 604622004681855]
        ];
    }

}