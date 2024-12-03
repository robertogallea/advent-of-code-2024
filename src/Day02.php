<?php

namespace Robertogallea\AdventOfCode2024;

class Day02
{

    public function solveFirstPart($list)
    {
        $list = explode("\n", $list);

        $safeReports = 0;

        foreach ($list as $item) {
            $report = preg_split('/\s+/', $item);
            if ($this->isReportSafe($report)) {
                $safeReports++;
            }
        }

        return $safeReports;
    }

    private function isReportSafe(array $report)
    {
        $diff = [];

        for ($i = 0; $i < count($report) - 1; $i++) {
            $diff[] = $report[$i] - $report[$i + 1];
        }

        if ($this->isRecordMonotonic($diff) &&
            $this->isRecordSlowlyChanging($diff)) {
            return true;
        }

        return false;
    }

    public function isRecordMonotonic(array $diff): bool
    {
        return ((min($diff) > 0) || (max($diff) < 0));
    }

    private function isRecordSlowlyChanging(array $diff)
    {
        return min($diff) > 0 ?
            (max($diff) <= 3) && (min($diff) >= 1) :
            (min($diff) >= -3) && (max($diff) <= -1);
    }

    /**
     * @param  array  $report
     * @return bool
     */
    public function checkReport(array $report): bool
    {

    }

    public function solveSecondPart($list)
    {
        $safeReports = 0;

        $list = explode("\n", $list);

        foreach ($list as $item) {
            $report = preg_split('/\s+/', $item);
            if ($this->isReportSafe($report)) {
                $safeReports++;
            } else {
                for ($i = 0; $i < count($report); $i++) {
                    $dampenedReport = $report;
                    array_splice($dampenedReport, $i, 1);
                    if ($this->isReportSafe($dampenedReport)) {
                        $safeReports++;
                        break;
                    }
                }
            }
        }

        return $safeReports;
    }

}