<?php

namespace Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Robertogallea\AdventOfCode2024\Day02;

class Day02Test extends TestCase
{
    #[Test]
    #[DataProvider('part1List')]
    public function it_works_with_part1($list, $expectedResult)
    {

        $puzzle = new Day02();
        $result = $puzzle->solveFirstPart($list);

        $this->assertEquals($expectedResult, $result);
    }

    public static function part1List()
    {
        return [
            yield 'example' => [
                "7 6 4 2 1".PHP_EOL.
                "1 2 7 8 9".PHP_EOL.
                "9 7 6 2 1".PHP_EOL.
                "1 3 2 4 5".PHP_EOL.
                "8 6 4 4 1".PHP_EOL.
                "1 3 6 7 9", 2
            ],
            yield 'actual input' => [file_get_contents(__DIR__."/Data/Day02/part1.txt"), 663]
        ];
    }

    #[Test]
    #[DataProvider('part2List')]
    public function it_works_with_part2($list, $expectedResult)
    {

        $puzzle = new Day02();
        $result = $puzzle->solveSecondPart($list);

        $this->assertEquals($expectedResult, $result);
    }

    public static function part2List()
    {
        return [
            yield 'example' => [
                "7 6 4 2 1".PHP_EOL.
                "1 2 7 8 9".PHP_EOL.
                "9 7 6 2 1".PHP_EOL.
                "1 3 2 4 5".PHP_EOL.
                "8 6 4 4 1".PHP_EOL.
                "1 3 6 7 9", 4
            ],
            yield 'actual input' => [file_get_contents(__DIR__."/Data/Day02/part2.txt"), 692]
        ];
    }

}
