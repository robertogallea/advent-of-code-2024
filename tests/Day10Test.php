<?php

namespace Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Robertogallea\AdventOfCode2024\Day10;

class Day10Test extends TestCase
{
    #[Test]
    #[DataProvider('part1List')]
    public function it_works_with_part1($list, $expectedResult)
    {

        $puzzle = new Day10();
        $result = $puzzle->solveFirstPart($list);

        $this->assertEquals($expectedResult, $result);
    }

    public static function part1List()
    {
        return [
            yield 'simple example' => [
                "...0...".PHP_EOL.
                "...1...".PHP_EOL.
                "...2...".PHP_EOL.
                "6543456".PHP_EOL.
                "7.....7".PHP_EOL.
                "8.....8".PHP_EOL.
                "9.....9", 2
            ],
            yield 'simple example 2' => [
                "..90..9".PHP_EOL.
                "...1.98".PHP_EOL.
                "...2..7".PHP_EOL.
                "6543456".PHP_EOL.
                "765.987".PHP_EOL.
                "876....".PHP_EOL.
                "987....", 4
            ],
            yield 'simple example 3' => [
                "10..9..".PHP_EOL.
                "2...8..".PHP_EOL.
                "3...7..".PHP_EOL.
                "4567654".PHP_EOL.
                "...8..3".PHP_EOL.
                "...9..2".PHP_EOL.
                ".....01", 3
            ],
            yield 'example' => [
                "89010123".PHP_EOL.
                "78121874".PHP_EOL.
                "87430965".PHP_EOL.
                "96549874".PHP_EOL.
                "45678903".PHP_EOL.
                "32019012".PHP_EOL.
                "01329801".PHP_EOL.
                "10456732", 36
            ],
            yield 'actual input' => [file_get_contents(__DIR__."/Data/Day10/part1.txt"), 512]
        ];
    }

    #[Test]
    #[DataProvider('part2List')]
    public function it_works_with_part2($list, $expectedResult)
    {

        $puzzle = new Day10();
        $result = $puzzle->solveSecondPart($list);

        $this->assertEquals($expectedResult, $result);
    }

    public static function part2List()
    {
        return [
            yield 'simple example 2' => [
                ".....0.".PHP_EOL.
                "..4321.".PHP_EOL.
                "..5..2.".PHP_EOL.
                "..6543.".PHP_EOL.
                "..7..4.".PHP_EOL.
                "..8765.".PHP_EOL.
                "..9....", 3
            ],
            yield 'simple example 3' => [
                "..90..9".PHP_EOL.
                "...1.98".PHP_EOL.
                "...2..7".PHP_EOL.
                "6543456".PHP_EOL.
                "765.987".PHP_EOL.
                "876....".PHP_EOL.
                "987....", 13
            ],
            yield 'example' => [
                "012345".PHP_EOL.
                "123456".PHP_EOL.
                "234567".PHP_EOL.
                "345678".PHP_EOL.
                "4.6789".PHP_EOL.
                "56789.", 227
            ],
            yield 'actual input' => [file_get_contents(__DIR__."/Data/Day10/part2.txt"), 512]
        ];
    }

}
