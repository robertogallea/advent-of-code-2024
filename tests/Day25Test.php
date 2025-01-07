<?php

namespace Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Robertogallea\AdventOfCode2024\Day24;
use Robertogallea\AdventOfCode2024\Day25;

class Day25Test extends TestCase
{
    #[Test]
    #[DataProvider('part1List')]
    public function it_works_with_part1($list, $expectedResult)
    {
        $puzzle = new Day25();

        $result = $puzzle->solveFirstPart($list);

        $this->assertEquals($expectedResult, $result);
    }

    public static function part1List()
    {
        return [
            yield 'simple example' => [
                '#####'.PHP_EOL.
                '.####'.PHP_EOL.
                '.####'.PHP_EOL.
                '.####'.PHP_EOL.
                '.#.#.'.PHP_EOL.
                '.#...'.PHP_EOL.
                '.....'.PHP_EOL.
                ''.PHP_EOL.
                '#####'.PHP_EOL.
                '##.##'.PHP_EOL.
                '.#.##'.PHP_EOL.
                '...##'.PHP_EOL.
                '...#.'.PHP_EOL.
                '...#.'.PHP_EOL.
                '.....'.PHP_EOL.
                ''.PHP_EOL.
                '.....'.PHP_EOL.
                '#....'.PHP_EOL.
                '#....'.PHP_EOL.
                '#...#'.PHP_EOL.
                '#.#.#'.PHP_EOL.
                '#.###'.PHP_EOL.
                '#####'.PHP_EOL.
                ''.PHP_EOL.
                '.....'.PHP_EOL.
                '.....'.PHP_EOL.
                '#.#..'.PHP_EOL.
                '###..'.PHP_EOL.
                '###.#'.PHP_EOL.
                '###.#'.PHP_EOL.
                '#####'.PHP_EOL.
                ''.PHP_EOL.
                '.....'.PHP_EOL.
                '.....'.PHP_EOL.
                '.....'.PHP_EOL.
                '#....'.PHP_EOL.
                '#.#..'.PHP_EOL.
                '#.#.#'.PHP_EOL.
                '#####', 3
            ],
            yield 'actual input' => [file_get_contents(__DIR__."/Data/Day25/part1.txt"), 2835]
        ];
    }

}