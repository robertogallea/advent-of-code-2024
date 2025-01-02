<?php

namespace Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Robertogallea\AdventOfCode2024\Day22;

class Day22Test extends TestCase
{
    #[Test]
    #[DataProvider('part1List')]
    public function it_works_with_part1($list, $expectedResult)
    {
        $puzzle = new Day22();

        $result = $puzzle->solveFirstPart($list);

        $this->assertEquals($expectedResult, $result);
    }

    public static function part1List()
    {
        return [
            yield 'simple example' => [
                "1".PHP_EOL.
                "10".PHP_EOL.
                "100".PHP_EOL.
                "2024", 37327623
            ],
            yield 'actual input' => [file_get_contents(__DIR__."/Data/Day22/part1.txt"), 16039090236]
        ];
    }

    #[Test]
    #[DataProvider('part2List')]
    public function it_works_with_part2($list, $expectedResult)
    {

        $puzzle = new Day22();
        $result = $puzzle->solveSecondPart($list);

        $this->assertEquals($expectedResult, $result);
    }

    public static function part2List()
    {
        return [
            yield 'simple example' => [
                "1".PHP_EOL.
                "10".PHP_EOL.
                "100".PHP_EOL.
                "2024", 24
            ],
            yield 'actual input' => [file_get_contents(__DIR__."/Data/Day22/part2.txt"), 1808]
        ];
    }

}