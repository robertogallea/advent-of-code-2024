<?php

namespace Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Robertogallea\AdventOfCode2024\Day17;

class Day17Test extends TestCase
{
    #[Test]
    #[DataProvider('part1List')]
    public function it_works_with_part1($list, $expectedResult)
    {
        $puzzle = new Day17();

        $result = $puzzle->solveFirstPart($list);

        $this->assertEquals($expectedResult, $result);
    }

    public static function part1List()
    {
        return [
            yield 'simple example' => [
                "Register A: 10".PHP_EOL.
                "Register B: 0".PHP_EOL.
                "Register C: 0".PHP_EOL.
                "".PHP_EOL.
                "Program: 5,0,5,1,5,4", '0,1,2'
            ],
            yield 'simple example 2' => [
                "Register A: 2024".PHP_EOL.
                "Register B: 0".PHP_EOL.
                "Register C: 0".PHP_EOL.
                "".PHP_EOL.
                "Program: 0,1,5,4,3,0", '4,2,5,6,7,7,7,7,3,1,0'
            ],
            yield 'simple example 3' => [
                "Register A: 729".PHP_EOL.
                "Register B: 0".PHP_EOL.
                "Register C: 0".PHP_EOL.
                "".PHP_EOL.
                "Program: 0,1,5,4,3,0", '4,6,3,5,6,3,5,2,1,0'
            ],
            yield 'actual input' => [file_get_contents(__DIR__."/Data/Day17/part1.txt"), '7,1,2,3,2,6,7,2,5']
        ];
    }

    #[Test]
    #[DataProvider('part2List')]
    public function it_works_with_part2($list, $expectedResult)
    {

        $puzzle = new Day17();
        $result = $puzzle->solveSecondPart($list);

        $this->assertEquals($expectedResult, $result);
    }

    public static function part2List()
    {
        return [
            yield 'simple example' => [
                "Register A: 2024".PHP_EOL.
                "Register B: 0".PHP_EOL.
                "Register C: 0".PHP_EOL.
                "".PHP_EOL.
                "Program: 0,3,5,4,3,0", 117440
            ],
            yield 'actual input' => [file_get_contents(__DIR__."/Data/Day17/part2.txt"), 202356708354602]
        ];
    }

}