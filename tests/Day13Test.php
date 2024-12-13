<?php

namespace Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Robertogallea\AdventOfCode2024\Day13;

class Day13Test extends TestCase
{
    #[Test]
    #[DataProvider('part1List')]
    public function it_works_with_part1($list, $expectedResult)
    {

        $puzzle = new Day13();
        $result = $puzzle->solveFirstPart($list);

        $this->assertEquals($expectedResult, $result);
    }

    public static function part1List()
    {
        return [
            yield 'simple example' => [
                "Button A: X+94, Y+34".PHP_EOL.
                "Button B: X+22, Y+67".PHP_EOL.
                "Prize: X=8400, Y=5400".PHP_EOL.
                PHP_EOL.
                "Button A: X+26, Y+66".PHP_EOL.
                "Button B: X+67, Y+21".PHP_EOL.
                "Prize: X=12748, Y=12176".PHP_EOL.
                PHP_EOL.
                "Button A: X+17, Y+86".PHP_EOL.
                "Button B: X+84, Y+37".PHP_EOL.
                "Prize: X=7870, Y=6450".PHP_EOL.
                PHP_EOL.
                "Button A: X+69, Y+23".PHP_EOL.
                "Button B: X+27, Y+71".PHP_EOL.
                "Prize: X=18641, Y=10279", 480
            ],
            yield 'actual input' => [file_get_contents(__DIR__."/Data/Day13/part1.txt"), 29023]
        ];
    }

    #[Test]
    #[DataProvider('part2List')]
    public function it_works_with_part2($list, $expectedResult)
    {

        $puzzle = new Day13();
        $result = $puzzle->solveSecondPart($list);

        $this->assertEquals($expectedResult, $result);
    }

    public static function part2List()
    {
        return [
            yield 'simple example' => [
                "Button A: X+94, Y+34".PHP_EOL.
                "Button B: X+22, Y+67".PHP_EOL.
                "Prize: X=8400, Y=5400".PHP_EOL.
                PHP_EOL.
                "Button A: X+26, Y+66".PHP_EOL.
                "Button B: X+67, Y+21".PHP_EOL.
                "Prize: X=12748, Y=12176".PHP_EOL.
                PHP_EOL.
                "Button A: X+17, Y+86".PHP_EOL.
                "Button B: X+84, Y+37".PHP_EOL.
                "Prize: X=7870, Y=6450".PHP_EOL.
                PHP_EOL.
                "Button A: X+69, Y+23".PHP_EOL.
                "Button B: X+27, Y+71".PHP_EOL.
                "Prize: X=18641, Y=10279", 875318608908
            ],
            yield 'actual input' => [file_get_contents(__DIR__."/Data/Day13/part2.txt"), 96787395375634]
        ];
    }

}
