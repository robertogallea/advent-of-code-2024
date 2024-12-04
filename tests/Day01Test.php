<?php

namespace Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Robertogallea\AdventOfCode2024\Day01;

class Day01Test extends TestCase
{
    #[Test]
    #[DataProvider('part1List')]
    public function it_works_with_part1($list, $expectedResult)
    {

        $puzzle = new Day01();
        $result = $puzzle->solveFirstPart($list);

        $this->assertEquals($expectedResult, $result);
    }

    public static function part1List()
    {
        return [
            yield 'example' => [
                "3   4".PHP_EOL.
                "4   3".PHP_EOL.
                "2   5".PHP_EOL.
                "1   3".PHP_EOL.
                "3   9".PHP_EOL.
                "3   3", 11
            ],
            yield 'actual input' => [file_get_contents(__DIR__."/Data/Day01/part1.txt"), 2904518]
        ];
    }

    #[Test]
    #[DataProvider('part2List')]
    public function it_works_with_part2($list, $expectedResult)
    {

        $puzzle = new Day01();
        $result = $puzzle->solveSecondPart($list);

        $this->assertEquals($expectedResult, $result);
    }

    public static function part2List()
    {
        return [
            yield 'example' => [
                "3   4".PHP_EOL.
                "4   3".PHP_EOL.
                "2   5".PHP_EOL.
                "1   3".PHP_EOL.
                "3   9".PHP_EOL.
                "3   3", 31
            ],
            yield 'actual input' => [file_get_contents(__DIR__."/Data/Day01/part2.txt"), 18650129]
        ];
    }

}
