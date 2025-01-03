<?php

namespace Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Robertogallea\AdventOfCode2024\Day24;

class Day24Test extends TestCase
{
    #[Test]
    #[DataProvider('part1List')]
    public function it_works_with_part1($list, $expectedResult)
    {
        $puzzle = new Day24();

        $result = $puzzle->solveFirstPart($list);

        $this->assertEquals($expectedResult, $result);
    }

    public static function part1List()
    {
        return [
            yield 'simple example' => [
                "x00: 1".PHP_EOL.
                "x01: 1".PHP_EOL.
                "x02: 1".PHP_EOL.
                "y00: 0".PHP_EOL.
                "y01: 1".PHP_EOL.
                "y02: 0".PHP_EOL.
                "".PHP_EOL.
                "x00 AND y00 -> z00".PHP_EOL.
                "x01 XOR y01 -> z01".PHP_EOL.
                "x02 OR y02 -> z02", 4
            ],
            yield 'simple example 2' => [
                "x00: 1".PHP_EOL.
                "x01: 0".PHP_EOL.
                "x02: 1".PHP_EOL.
                "x03: 1".PHP_EOL.
                "x04: 0".PHP_EOL.
                "y00: 1".PHP_EOL.
                "y01: 1".PHP_EOL.
                "y02: 1".PHP_EOL.
                "y03: 1".PHP_EOL.
                "y04: 1".PHP_EOL.
                "".PHP_EOL.
                "ntg XOR fgs -> mjb".PHP_EOL.
                "y02 OR x01 -> tnw".PHP_EOL.
                "kwq OR kpj -> z05".PHP_EOL.
                "x00 OR x03 -> fst".PHP_EOL.
                "tgd XOR rvg -> z01".PHP_EOL.
                "vdt OR tnw -> bfw".PHP_EOL.
                "bfw AND frj -> z10".PHP_EOL.
                "ffh OR nrd -> bqk".PHP_EOL.
                "y00 AND y03 -> djm".PHP_EOL.
                "y03 OR y00 -> psh".PHP_EOL.
                "bqk OR frj -> z08".PHP_EOL.
                "tnw OR fst -> frj".PHP_EOL.
                "gnj AND tgd -> z11".PHP_EOL.
                "bfw XOR mjb -> z00".PHP_EOL.
                "x03 OR x00 -> vdt".PHP_EOL.
                "gnj AND wpb -> z02".PHP_EOL.
                "x04 AND y00 -> kjc".PHP_EOL.
                "djm OR pbm -> qhw".PHP_EOL.
                "nrd AND vdt -> hwm".PHP_EOL.
                "kjc AND fst -> rvg".PHP_EOL.
                "y04 OR y02 -> fgs".PHP_EOL.
                "y01 AND x02 -> pbm".PHP_EOL.
                "ntg OR kjc -> kwq".PHP_EOL.
                "psh XOR fgs -> tgd".PHP_EOL.
                "qhw XOR tgd -> z09".PHP_EOL.
                "pbm OR djm -> kpj".PHP_EOL.
                "x03 XOR y03 -> ffh".PHP_EOL.
                "x00 XOR y04 -> ntg".PHP_EOL.
                "bfw OR bqk -> z06".PHP_EOL.
                "nrd XOR fgs -> wpb".PHP_EOL.
                "frj XOR qhw -> z04".PHP_EOL.
                "bqk OR frj -> z07".PHP_EOL.
                "y03 OR x01 -> nrd".PHP_EOL.
                "hwm AND bqk -> z03".PHP_EOL.
                "tgd XOR rvg -> z12".PHP_EOL.
                "tnw OR pbm -> gnj", 2024
            ],
            yield 'actual input' => [file_get_contents(__DIR__."/Data/Day24/part1.txt"), 56278503604006]
        ];
    }

    #[Test]
    #[DataProvider('part2List')]
    public function it_works_with_part2($list, $expectedResult)
    {

        $puzzle = new Day24();
        $result = $puzzle->solveSecondPart($list);

        $this->assertEquals($expectedResult, $result);
    }

    public static function part2List()
    {
        return [
            yield 'actual input' => [
                file_get_contents(__DIR__."/Data/Day24/part2.txt"), 'bhd,brk,dhg,dpd,nbf,z06,z23,z38'
            ]
        ];
    }

}