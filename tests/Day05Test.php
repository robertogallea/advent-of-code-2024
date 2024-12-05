<?php

namespace Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Robertogallea\AdventOfCode2024\Day05;

class Day05Test extends TestCase
{
    #[Test]
    #[DataProvider('part1List')]
    public function it_works_with_part1($list, $expectedResult)
    {

        $puzzle = new Day05();
        $result = $puzzle->solveFirstPart($list);

        $this->assertEquals($expectedResult, $result);
    }

    public static function part1List()
    {
        return [
            yield 'example' => [
                "47|53".PHP_EOL.
                "97|13".PHP_EOL.
                "97|61".PHP_EOL.
                "97|47".PHP_EOL.
                "75|29".PHP_EOL.
                "61|13".PHP_EOL.
                "75|53".PHP_EOL.
                "29|13".PHP_EOL.
                "97|29".PHP_EOL.
                "53|29".PHP_EOL.
                "61|53".PHP_EOL.
                "97|53".PHP_EOL.
                "61|29".PHP_EOL.
                "47|13".PHP_EOL.
                "75|47".PHP_EOL.
                "97|75".PHP_EOL.
                "47|61".PHP_EOL.
                "75|61".PHP_EOL.
                "47|29".PHP_EOL.
                "75|13".PHP_EOL.
                "53|13".PHP_EOL.
                "".PHP_EOL.
                "75,47,61,53,29".PHP_EOL.
                "97,61,53,29,13".PHP_EOL.
                "75,29,13".PHP_EOL.
                "75,97,47,61,53".PHP_EOL.
                "61,13,29".PHP_EOL.
                "97,13,75,29,47", 143
            ],
            yield 'actual input' => [file_get_contents(__DIR__."/Data/Day05/part1.txt"), 4959]
        ];
    }

    #[Test]
    #[DataProvider('part2List')]
    public function it_works_with_part2($list, $expectedResult)
    {

        $puzzle = new Day05();
        $result = $puzzle->solveSecondPart($list);

        $this->assertEquals($expectedResult, $result);
    }

    public static function part2List()
    {
        return [
            yield 'example' => [
                "47|53".PHP_EOL.
                "97|13".PHP_EOL.
                "97|61".PHP_EOL.
                "97|47".PHP_EOL.
                "75|29".PHP_EOL.
                "61|13".PHP_EOL.
                "75|53".PHP_EOL.
                "29|13".PHP_EOL.
                "97|29".PHP_EOL.
                "53|29".PHP_EOL.
                "61|53".PHP_EOL.
                "97|53".PHP_EOL.
                "61|29".PHP_EOL.
                "47|13".PHP_EOL.
                "75|47".PHP_EOL.
                "97|75".PHP_EOL.
                "47|61".PHP_EOL.
                "75|61".PHP_EOL.
                "47|29".PHP_EOL.
                "75|13".PHP_EOL.
                "53|13".PHP_EOL.
                "".PHP_EOL.
                "75,47,61,53,29".PHP_EOL.
                "97,61,53,29,13".PHP_EOL.
                "75,29,13".PHP_EOL.
                "75,97,47,61,53".PHP_EOL.
                "61,13,29".PHP_EOL.
                "97,13,75,29,47", 123
            ],
            yield 'actual input' => [file_get_contents(__DIR__."/Data/Day05/part2.txt"), 4655]
        ];
    }

}
