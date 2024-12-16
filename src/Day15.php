<?php

namespace Robertogallea\AdventOfCode2024;

class Day15
{
    public function solveFirstPart(string $input): int
    {
        [$map, $moves] = $this->readMap($input);

        $cursor = $this->getCursor($map);

        foreach ($moves as $move) {
            if ($this->canMove($map, $move, $cursor)) {
                $cursor = $this->move($map, $move, $cursor);
            }
        }

        return $this->computeScore($map);
    }

    public function solveSecondPart(string $input): int
    {
        [$map, $moves] = $this->readExpandedMap($input);

        $cursor = $this->getCursor($map);

        foreach ($moves as $move) {
            if ($this->canMove($map, $move, $cursor)) {
                $cursor = $this->move($map, $move, $cursor);
            }
        }

        return $this->computeScore($map);
    }

    private function readMap(string $input): array
    {
        [$map, $moves] = explode(PHP_EOL.PHP_EOL, $input);

        $map = array_map('str_split', explode(PHP_EOL, $map));
        $moves = str_split(str_replace(PHP_EOL, '', $moves));

        return [$map, $moves];
    }

    private function canMove(array &$map, string $move, array $cursor): bool
    {
        switch ($map[$cursor[0]][$cursor[1]]) {
            case Token::FREE->value:
                return true;
            case Token::WALL->value:
                return false;

            case Token::ROBOT->value:
            case Token::BOX->value:
                $nextCursor = $this->getNextCursor($move, $cursor);
                return ($this->canMove($map, $move, $nextCursor));

            case Token::LEFT_BOX->value:
                $nextCursor = $this->getNextCursor($move, $cursor);
                if (in_array($move, [Direction::UP->value, Direction::DOWN->value])) {
                    $otherNextCursor = $nextCursor;
                    $otherCursor = $cursor;
                    $otherNextCursor[1] += 1;
                    $otherCursor[1] += 1;
                    return ($this->canMove($map, $move, $nextCursor) && $this->canMove($map, $move, $otherNextCursor));
                } else {
                    return $this->canMove($map, $move, $nextCursor);
                }
                // no break
            case Token::RIGHT_BOX->value:
                $nextCursor = $this->getNextCursor($move, $cursor);
                if (in_array($move, [Direction::UP->value, Direction::DOWN->value])) {
                    $otherNextCursor = $nextCursor;
                    $otherCursor = $cursor;
                    $otherNextCursor[1] -= 1;
                    $otherCursor[1] -= 1;
                    return ($this->canMove($map, $move, $nextCursor) && $this->canMove($map, $move, $otherNextCursor));
                } else {
                    return $this->canMove($map, $move, $nextCursor);
                }
        }

        return false;
    }

    private function move(array &$map, string $move, array $cursor): ?array
    {
        switch ($map[$cursor[0]][$cursor[1]]) {
            case Token::FREE->value:
                return $cursor;
            case Token::WALL->value:
                return null;

            case Token::ROBOT->value:
            case Token::BOX->value:
                $nextCursor = $this->getNextCursor($move, $cursor);
                $this->move($map, $move, $nextCursor);
                $map[$nextCursor[0]][$nextCursor[1]] = $map[$cursor[0]][$cursor[1]];
                $map[$cursor[0]][$cursor[1]] = Token::FREE->value;
                return $nextCursor;

            case Token::LEFT_BOX->value:
                $nextCursor = $this->getNextCursor($move, $cursor);
                if (in_array($move, [Direction::UP->value, Direction::DOWN->value])) {
                    $otherNextCursor = $nextCursor;
                    $otherCursor = $cursor;
                    $otherNextCursor[1] += 1;
                    $otherCursor[1] += 1;
                    $this->move($map, $move, $nextCursor);
                    $this->move($map, $move, $otherNextCursor);
                    $map[$nextCursor[0]][$nextCursor[1]] = $map[$cursor[0]][$cursor[1]];
                    $map[$cursor[0]][$cursor[1]] = Token::FREE->value;
                    $map[$otherNextCursor[0]][$otherNextCursor[1]] = $map[$otherCursor[0]][$otherCursor[1]];
                    $map[$otherCursor[0]][$otherCursor[1]] = Token::FREE->value;
                } else {
                    $this->move($map, $move, $nextCursor);
                    $map[$nextCursor[0]][$nextCursor[1]] = $map[$cursor[0]][$cursor[1]];
                    $map[$cursor[0]][$cursor[1]] = Token::FREE->value;
                }
                return $nextCursor;
            case Token::RIGHT_BOX->value:
                $nextCursor = $this->getNextCursor($move, $cursor);
                if (in_array($move, [Direction::UP->value, Direction::DOWN->value])) {
                    $otherNextCursor = $nextCursor;
                    $otherCursor = $cursor;
                    $otherNextCursor[1] -= 1;
                    $otherCursor[1] -= 1;
                    $this->move($map, $move, $nextCursor);
                    $this->move($map, $move, $otherNextCursor);
                    $map[$nextCursor[0]][$nextCursor[1]] = $map[$cursor[0]][$cursor[1]];
                    $map[$cursor[0]][$cursor[1]] = Token::FREE->value;
                    $map[$otherNextCursor[0]][$otherNextCursor[1]] = $map[$otherCursor[0]][$otherCursor[1]];
                    $map[$otherCursor[0]][$otherCursor[1]] = Token::FREE->value;
                } else {
                    $this->move($map, $move, $nextCursor);
                    $map[$nextCursor[0]][$nextCursor[1]] = $map[$cursor[0]][$cursor[1]];
                    $map[$cursor[0]][$cursor[1]] = Token::FREE->value;
                }
                return $nextCursor;
        }

        return null;
    }


    private function getCursor(
        mixed $map
    ) {
        foreach (range(1, count($map) - 2) as $i) {
            foreach (range(1, count($map) - 2) as $j) {
                if ($map[$i][$j] === Token::ROBOT->value) {
                    return [$i, $j];
                }
            }
        }
    }

    private function getNextCursor(
        string $move,
        array $cursor
    ): array {
        return match ($move) {
            Direction::LEFT->value => [$cursor[0], $cursor[1] - 1],
            Direction::RIGHT->value => [$cursor[0], $cursor[1] + 1],
            Direction::UP->value => [$cursor[0] - 1, $cursor[1]],
            Direction::DOWN->value => [$cursor[0] + 1, $cursor[1]],
        };
    }

    private function dumpColouredMap(
        array $map
    ) {
        foreach ($map as $row) {
            foreach ($row as $cell) {
                echo match ($cell) {
                    Token::ROBOT->value => "\033[32m",
                    Token::BOX->value, Token::LEFT_BOX->value, Token::RIGHT_BOX->value => "\033[33m",
                    Token::WALL->value => "\033[31m",
                    Token::FREE->value => "\033[30m",
                    default => "\033[0m",
                }.$cell;
            }
            echo PHP_EOL;
        }
    }

    private function dumpMap(
        array $map
    ) {
        foreach ($map as $row) {
            echo implode('', $row).PHP_EOL;
        }
    }

    private function computeScore(
        array $map
    ): int {
        $score = 0;

        foreach ($map as $i => $row) {
            foreach ($row as $j => $cell) {
                if (in_array($cell, [Token::BOX->value, Token::LEFT_BOX->value])) {
                    $score += $i * 100 + $j;
                }
            }
        }

        return $score;
    }

    private function readExpandedMap(
        string $input
    ): array {
        [$map, $moves] = explode(PHP_EOL.PHP_EOL, $input);


        $map = array_map(
            'str_split',
            explode(PHP_EOL, $map)
        );

        foreach ($map as &$line) {
            $line = array_merge(...array_map(function (string $element) {
                return match ($element) {
                    Token::FREE->value => [Token::FREE->value, Token::FREE->value],
                    Token::BOX->value => [Token::LEFT_BOX->value, Token::RIGHT_BOX->value],
                    Token::WALL->value => [Token::WALL->value, Token::WALL->value],
                    Token::ROBOT->value => [Token::ROBOT->value, Token::FREE->value],
                    default => null,
                };
            }, $line));
        }


        $moves = str_split(str_replace(PHP_EOL, '', $moves));

        return [$map, $moves];
    }
}

enum Token: string
{
    case WALL = '#';
    case BOX = 'O';
    case ROBOT = '@';
    case FREE = '.';
    case LEFT_BOX = '[';
    case RIGHT_BOX = ']';
}

enum Direction: string
{
    case UP = '^';
    case DOWN = 'v';
    case LEFT = '<';
    case RIGHT = '>';
}
