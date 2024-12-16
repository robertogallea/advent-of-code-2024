<?php

namespace Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Robertogallea\AdventOfCode2024\Day13;
use Robertogallea\AdventOfCode2024\Day14;
use Robertogallea\AdventOfCode2024\Day15;

class Day15Test extends TestCase
{
    #[Test]
    #[DataProvider('part1List')]
    public function it_works_with_part1($list, $expectedResult)
    {

        $puzzle = new Day15();
        $result = $puzzle->solveFirstPart($list);

        $this->assertEquals($expectedResult, $result);
    }

    public static function part1List()
    {
        return [
            yield 'simple example' => [
                "########".PHP_EOL.
                "#..O.O.#".PHP_EOL.
                "##@.O..#".PHP_EOL.
                "#...O..#".PHP_EOL.
                "#.#.O..#".PHP_EOL.
                "#...O..#".PHP_EOL.
                "#......#".PHP_EOL.
                "########".PHP_EOL.
                "".PHP_EOL.
                "<^^>>>vv<v>>v<<", 2028,
            ],
            yield 'simple example 2' => [
                "##########".PHP_EOL.
                "#..O..O.O#".PHP_EOL.
                "#......O.#".PHP_EOL.
                "#.OO..O.O#".PHP_EOL.
                "#..O@..O.#".PHP_EOL.
                "#O#..O...#".PHP_EOL.
                "#O..O..O.#".PHP_EOL.
                "#.OO.O.OO#".PHP_EOL.
                "#....O...#".PHP_EOL.
                "##########".PHP_EOL.
                "".PHP_EOL.
                "<vv>^<v^>v>^vv^v>v<>v^v<v<^vv<<<^><<><>>v<vvv<>^v^>^<<<><<v<<<v^vv^v>^".PHP_EOL.
                "vvv<<^>^v^^><<>>><>^<<><^vv^^<>vvv<>><^^v>^>vv<>v<<<<v<^v>^<^^>>>^<v<v".PHP_EOL.
                "><>vv>v^v^<>><>>>><^^>vv>v<^^^>>v^v^<^^>v^^>v^<^v>v<>>v^v^<v>v^^<^^vv<".PHP_EOL.
                "<<v<^>>^^^^>>>v^<>vvv^><v<<<>^^^vv^<vvv>^>v<^^^^v<>^>vvvv><>>v^<<^^^^^".PHP_EOL.
                "^><^><>>><>^^<<^^v>>><^<v>^<vv>>v>>>^v><>^v><<<<v>>v<v<v>vvv>^<><<>^><".PHP_EOL.
                "^>><>^v<><^vvv<^^<><v<<<<<><^v<<<><<<^^<v<^^^><^>>^<v^><<<^>>^v<v^v<v^".PHP_EOL.
                ">^>>^v>vv>^<<^v<>><<><<v<<v><>v<^vv<<<>^^v^>^^>>><<^v>>v^v><^^>>^<>vv^".PHP_EOL.
                "<><^^>^^^<><vvvvv^v<v<<>^v<v>v<<^><<><<><<<^^<<<^<<>><<><^^^>^^<>^>v<>".PHP_EOL.
                "^^>vv<^v^v<vv>^<><v<^v>^^^>>>^^vvv^>vvv<>>>^<^>>>>>^<<^v>^vvv<>^<><<v>".PHP_EOL.
                "v^^>>><<^^<>>^v^<v^vv<>v^<<>^<^v^v><^<<<><<^<v><v<>vv>>v><v^<vv<>v^<<^", 10092
            ],
            yield 'actual input' => [file_get_contents(__DIR__."/Data/Day15/part1.txt"), 1360570]
        ];
    }

    #[Test]
    #[DataProvider('part2List')]
    public function it_works_with_part2($list, $expectedResult)
    {

        $puzzle = new Day15();
        $result = $puzzle->solveSecondPart($list);

        $this->assertEquals($expectedResult, $result);
    }

    public static function part2List()
    {
        return [
            yield 'simple example' => [
                "########".PHP_EOL.
                "#..O.O.#".PHP_EOL.
                "##@.O..#".PHP_EOL.
                "#...O..#".PHP_EOL.
                "#.#.O..#".PHP_EOL.
                "#...O..#".PHP_EOL.
                "#......#".PHP_EOL.
                "########".PHP_EOL.
                "".PHP_EOL.
                "<^^>>>vv<v>>v<<", 1751,
            ],
            yield 'simple example 2' => [
                "##########".PHP_EOL.
                "#..O..O.O#".PHP_EOL.
                "#......O.#".PHP_EOL.
                "#.OO..O.O#".PHP_EOL.
                "#..O@..O.#".PHP_EOL.
                "#O#..O...#".PHP_EOL.
                "#O..O..O.#".PHP_EOL.
                "#.OO.O.OO#".PHP_EOL.
                "#....O...#".PHP_EOL.
                "##########".PHP_EOL.
                "".PHP_EOL.
                "<vv>^<v^>v>^vv^v>v<>v^v<v<^vv<<<^><<><>>v<vvv<>^v^>^<<<><<v<<<v^vv^v>^".PHP_EOL.
                "vvv<<^>^v^^><<>>><>^<<><^vv^^<>vvv<>><^^v>^>vv<>v<<<<v<^v>^<^^>>>^<v<v".PHP_EOL.
                "><>vv>v^v^<>><>>>><^^>vv>v<^^^>>v^v^<^^>v^^>v^<^v>v<>>v^v^<v>v^^<^^vv<".PHP_EOL.
                "<<v<^>>^^^^>>>v^<>vvv^><v<<<>^^^vv^<vvv>^>v<^^^^v<>^>vvvv><>>v^<<^^^^^".PHP_EOL.
                "^><^><>>><>^^<<^^v>>><^<v>^<vv>>v>>>^v><>^v><<<<v>>v<v<v>vvv>^<><<>^><".PHP_EOL.
                "^>><>^v<><^vvv<^^<><v<<<<<><^v<<<><<<^^<v<^^^><^>>^<v^><<<^>>^v<v^v<v^".PHP_EOL.
                ">^>>^v>vv>^<<^v<>><<><<v<<v><>v<^vv<<<>^^v^>^^>>><<^v>>v^v><^^>>^<>vv^".PHP_EOL.
                "<><^^>^^^<><vvvvv^v<v<<>^v<v>v<<^><<><<><<<^^<<<^<<>><<><^^^>^^<>^>v<>".PHP_EOL.
                "^^>vv<^v^v<vv>^<><v<^v>^^^>>>^^vvv^>vvv<>>>^<^>>>>>^<<^v>^vvv<>^<><<v>".PHP_EOL.
                "v^^>>><<^^<>>^v^<v^vv<>v^<<>^<^v^v><^<<<><<^<v><v<>vv>>v><v^<vv<>v^<<^", 9021
            ],
            yield 'actual input' => [file_get_contents(__DIR__."/Data/Day15/part2.txt"), 1381446]
        ];
    }

}
