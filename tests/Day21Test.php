<?php

namespace Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Robertogallea\AdventOfCode2024\Day21;

class Day21Test extends TestCase
{
    #[Test]
    #[DataProvider('part1List')]
    public function it_works_with_part1($list, $expectedResult)
    {
        $puzzle = new Day21();

        $result = $puzzle->solveFirstPart($list);

        $this->assertEquals($expectedResult, $result);
    }

    public static function part1List()
    {
        return [
            yield 'simple example' => [
                "029A".PHP_EOL.
                "980A".PHP_EOL.
                "179A".PHP_EOL.
                "456A".PHP_EOL.
                "379A", 126384
            ],
            yield 'actual input' => [file_get_contents(__DIR__."/Data/Day21/part1.txt"), 109758]
        ];
    }

    #[Test]
    #[DataProvider('part2List')]
    public function it_works_with_part2($list, $expectedResult)
    {

        $puzzle = new Day21();
        $result = $puzzle->solveSecondPart($list);

        $this->assertEquals($expectedResult, $result);
    }

    public static function part2List()
    {
        return [
            yield 'actual input' => [file_get_contents(__DIR__."/Data/Day21/part2.txt"), 134341709499296]
        ];
    }

}