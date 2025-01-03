<?php

namespace Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Robertogallea\AdventOfCode2024\Day23;

class Day23Test extends TestCase
{
    #[Test]
    #[DataProvider('part1List')]
    public function it_works_with_part1($list, $expectedResult)
    {
        $puzzle = new Day23();

        $result = $puzzle->solveFirstPart($list);

        $this->assertEquals($expectedResult, $result);
    }

    public static function part1List()
    {
        return [
            yield 'simple example' => [
                "kh-tc".PHP_EOL.
                "qp-kh".PHP_EOL.
                "de-cg".PHP_EOL.
                "ka-co".PHP_EOL.
                "yn-aq".PHP_EOL.
                "qp-ub".PHP_EOL.
                "cg-tb".PHP_EOL.
                "vc-aq".PHP_EOL.
                "tb-ka".PHP_EOL.
                "wh-tc".PHP_EOL.
                "yn-cg".PHP_EOL.
                "kh-ub".PHP_EOL.
                "ta-co".PHP_EOL.
                "de-co".PHP_EOL.
                "tc-td".PHP_EOL.
                "tb-wq".PHP_EOL.
                "wh-td".PHP_EOL.
                "ta-ka".PHP_EOL.
                "td-qp".PHP_EOL.
                "aq-cg".PHP_EOL.
                "wq-ub".PHP_EOL.
                "ub-vc".PHP_EOL.
                "de-ta".PHP_EOL.
                "wq-aq".PHP_EOL.
                "wq-vc".PHP_EOL.
                "wh-yn".PHP_EOL.
                "ka-de".PHP_EOL.
                "kh-ta".PHP_EOL.
                "co-tc".PHP_EOL.
                "wh-qp".PHP_EOL.
                "tb-vc".PHP_EOL.
                "td-yn", 7
            ],
            yield 'actual input' => [file_get_contents(__DIR__."/Data/Day23/part1.txt"), 1337]
        ];
    }

    #[Test]
    #[DataProvider('part2List')]
    public function it_works_with_part2($list, $expectedResult)
    {

        $puzzle = new Day23();
        $result = $puzzle->solveSecondPart($list);

        $this->assertEquals($expectedResult, $result);
    }

    public static function part2List()
    {
        return [
            yield 'simple example' => [
                "kh-tc".PHP_EOL.
                "qp-kh".PHP_EOL.
                "de-cg".PHP_EOL.
                "ka-co".PHP_EOL.
                "yn-aq".PHP_EOL.
                "qp-ub".PHP_EOL.
                "cg-tb".PHP_EOL.
                "vc-aq".PHP_EOL.
                "tb-ka".PHP_EOL.
                "wh-tc".PHP_EOL.
                "yn-cg".PHP_EOL.
                "kh-ub".PHP_EOL.
                "ta-co".PHP_EOL.
                "de-co".PHP_EOL.
                "tc-td".PHP_EOL.
                "tb-wq".PHP_EOL.
                "wh-td".PHP_EOL.
                "ta-ka".PHP_EOL.
                "td-qp".PHP_EOL.
                "aq-cg".PHP_EOL.
                "wq-ub".PHP_EOL.
                "ub-vc".PHP_EOL.
                "de-ta".PHP_EOL.
                "wq-aq".PHP_EOL.
                "wq-vc".PHP_EOL.
                "wh-yn".PHP_EOL.
                "ka-de".PHP_EOL.
                "kh-ta".PHP_EOL.
                "co-tc".PHP_EOL.
                "wh-qp".PHP_EOL.
                "tb-vc".PHP_EOL.
                "td-yn", "co,de,ka,ta"
            ],
            yield 'actual input' => [file_get_contents(__DIR__."/Data/Day23/part2.txt"), "aw,fk,gv,hi,hp,ip,jy,kc,lk,og,pj,re,sr"]
        ];
    }

}