<?php

namespace Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Robertogallea\AdventOfCode2024\Day13;
use Robertogallea\AdventOfCode2024\Day14;

class Day14Test extends TestCase
{
    #[Test]
    #[DataProvider('part1List')]
    public function it_works_with_part1($list, $sizes, $expectedResult)
    {

        $puzzle = new Day14();
        $result = $puzzle->solveFirstPart($list, $sizes);

        $this->assertEquals($expectedResult, $result);
    }

    public static function part1List()
    {
        return [
            yield 'simple example' => [
                "p=0,4 v=3,-3".PHP_EOL.
                "p=6,3 v=-1,-3".PHP_EOL.
                "p=10,3 v=-1,2".PHP_EOL.
                "p=2,0 v=2,-1".PHP_EOL.
                "p=0,0 v=1,3".PHP_EOL.
                "p=3,0 v=-2,-2".PHP_EOL.
                "p=7,6 v=-1,-3".PHP_EOL.
                "p=3,0 v=-1,-2".PHP_EOL.
                "p=9,3 v=2,3".PHP_EOL.
                "p=7,3 v=-1,2".PHP_EOL.
                "p=2,4 v=2,-3".PHP_EOL.
                "p=9,5 v=-3,-3", [11, 7], 12
            ],
            yield 'actual input' => [file_get_contents(__DIR__."/Data/Day14/part1.txt"), [101, 103], 225810288]
        ];
    }

    #[Test]
    #[DataProvider('part2List')]
    public function it_works_with_part2($list, $sizes, $expectedResult)
    {

        $puzzle = new Day14();
        $result = $puzzle->solveSecondPart($list, $sizes);

        $this->assertEquals($expectedResult, $result);
    }

    public static function part2List()
    {
        return [
            yield 'actual input' => [file_get_contents(__DIR__."/Data/Day14/part2.txt"), [101, 103], 6752]
        ];
    }

}
