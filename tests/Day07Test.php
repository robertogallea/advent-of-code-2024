<?php

namespace Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Robertogallea\AdventOfCode2024\Day07;

class Day07Test extends TestCase
{
    #[Test]
    #[DataProvider('part1List')]
    public function it_works_with_part1($list, $expectedResult)
    {

        $puzzle = new Day07();
        $result = $puzzle->solveFirstPart($list);
var_dump($result);
        $this->assertEquals($expectedResult, $result);
    }

    public static function part1List()
    {
        return [
            yield 'example' => [
                "190: 10 19".PHP_EOL.
                "3267: 81 40 27".PHP_EOL.
                "83: 17 5".PHP_EOL.
                "156: 15 6".PHP_EOL.
                "7290: 6 8 6 15".PHP_EOL.
                "161011: 16 10 13".PHP_EOL.
                "192: 17 8 14".PHP_EOL.
                "21037: 9 7 18 13".PHP_EOL.
                "292: 11 6 16 20", 3749
            ],
            yield 'actual input' => [file_get_contents(__DIR__."/Data/Day07/part1.txt"), 6231007345478]
        ];
    }

    #[Test]
    #[DataProvider('part2List')]
    public function it_works_with_part2($list, $expectedResult)
    {

        $puzzle = new Day07();
        $result = $puzzle->solveSecondPart($list);

        $this->assertEquals($expectedResult, $result);
    }

    public static function part2List()
    {
        return [
            yield 'example' => [
                "190: 10 19".PHP_EOL.
                "3267: 81 40 27".PHP_EOL.
                "83: 17 5".PHP_EOL.
                "156: 15 6".PHP_EOL.
                "7290: 6 8 6 15".PHP_EOL.
                "161011: 16 10 13".PHP_EOL.
                "192: 17 8 14".PHP_EOL.
                "21037: 9 7 18 13".PHP_EOL.
                "292: 11 6 16 20", 11387
            ],
            yield 'actual input' => [file_get_contents(__DIR__."/Data/Day07/part2.txt"), 1562]
        ];
    }

}
