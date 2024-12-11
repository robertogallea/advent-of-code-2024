<?php

namespace Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Robertogallea\AdventOfCode2024\Day10;
use Robertogallea\AdventOfCode2024\Day11;

class Day11Test extends TestCase
{
    #[Test]
    #[DataProvider('part1List')]
    public function it_works_with_part1($list, $blinks, $expectedResult)
    {

        $puzzle = new Day11();
        $result = $puzzle->solveFirstPart($list, $blinks);

        $this->assertEquals($expectedResult, $result);
    }

    public static function part1List()
    {
        return [
            yield 'simple example' => ["0 1 10 99 999", 1, 7],
            yield 'simple example 2' => ["125 17", 6, 22],
            yield 'simple example 3' => ["125 17", 25, 55312],
            yield 'actual input' => [file_get_contents(__DIR__."/Data/Day11/part1.txt"), 25, 220722]
        ];
    }

    #[Test]
    #[DataProvider('part2List')]
    public function it_works_with_part2($list, $blinks,  $expectedResult)
    {

        $puzzle = new Day11();
        $result = $puzzle->solveSecondPart($list, $blinks);

        $this->assertEquals($expectedResult, $result);
    }

    public static function part2List()
    {
        return [
            yield 'actual input' => [file_get_contents(__DIR__."/Data/Day11/part1.txt"), 75, 261952051690787]
        ];
    }

}
