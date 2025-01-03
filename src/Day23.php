<?php

namespace Robertogallea\AdventOfCode2024;

class Day23
{
    public function solveFirstPart(string $input): int
    {
        $map = $this->parseInput($input);

        $adj = $this->makeAdjMap($map);
        ksort($adj);

        $sets = [];
        // for each node
        foreach ($adj as $node1Key => $nodeRow) {
            if ($node1Key[0] === 't') {
                // for each node connected to the first
                foreach (array_keys($nodeRow) as $node2Key) {
                    // for each any other node...
                    foreach (array_keys($adj[$node2Key]) as $node3Key) {
                        // ... if it is connected, add a triplet
                        if (isset($adj[$node3Key][$node1Key])) {
                            $triplet = [$node1Key, $node2Key, $node3Key];
                            sort($triplet);
                            $sets[implode('-', $triplet)] = 1;
                        }
                    }
                }
            }
        }

        return count($sets);
    }

    public function solveSecondPart(string $input): string
    {
        $map = $this->parseInput($input);

        $adj = $this->makeAdjMap($map);
        ksort($adj);

        return implode(",", $this->findLargestClique($adj, array_keys($adj)));
    }

    private function parseInput(string $input)
    {
        return array_map(fn($connection) => explode('-', $connection), explode("\n", $input));
    }

    private function makeAdjMap(array $map): array
    {
        $adj = [];
        foreach ($map as [$a, $b]) {
            $adj[$a] ??= [];
            $adj[$b] ??= [];
            $adj[$a][$b] ??= 1;
            $adj[$b][$a] ??= 1;
        }

        return $adj;
    }

    // Bron-Kerbosch Algorithm
    private function findLargestClique(array $graph, $candidates, $currentClique = [], $excluded = [])
    {
        // Base case: If there are no candidates and no excluded vertices,
        // the current clique is maximal and can be returned.
        if (empty($candidates) && empty($excluded)) {
            return $currentClique;
        }

        $largestClique = $currentClique;

        // Iterate over each vertex in the candidate set
        foreach ($candidates as $vertex) {
            // Get neighbors of the current vertex
            $neighbors = isset($graph[$vertex]) ? array_keys($graph[$vertex]) : [];

            // Recursive call to find the largest clique that includes the current vertex
            $potentialClique = $this->findLargestClique(
                $graph,
                array_intersect($candidates, $neighbors), // Restrict candidates to neighbors
                array_merge($currentClique, [$vertex]),  // Add the current vertex to the clique
                array_intersect($excluded, $neighbors)   // Restrict excluded vertices to neighbors
            );

            // Update the largest clique if the potential clique is larger
            if (count($potentialClique) > count($largestClique)) {
                $largestClique = $potentialClique;
            }

            // Update candidates and excluded sets
            $candidates = array_diff($candidates, [$vertex]);
            $excluded = array_merge($excluded, [$vertex]);
        }

        return $largestClique;
    }

}
