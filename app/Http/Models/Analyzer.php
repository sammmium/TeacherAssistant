<?php

namespace App\Http\Models;

use App\Http\Interfaces\AnalyzerInterface;

class Analyzer extends BaseModel implements AnalyzerInterface
{
    protected $analyzer = [];

    public function getAnalyzedData(): array
    {
        return [];
    }

    protected function prepareRanges(): void
    {
        $this->analyzer['cm_10'] = Cards::countMembersWithRange($this->analyzer['test_id'], 10);
        $this->analyzer['pm_10'] = $this->getPercent($this->analyzer['cm_10']);
        $this->analyzer['cm_9'] = Cards::countMembersWithRange($this->analyzer['test_id'], 9);
        $this->analyzer['pm_9'] = $this->getPercent($this->analyzer['cm_9']);
        $this->analyzer['cm_8'] = Cards::countMembersWithRange($this->analyzer['test_id'], 8);
        $this->analyzer['pm_8'] = $this->getPercent($this->analyzer['cm_8']);
        $this->analyzer['cm_7'] = Cards::countMembersWithRange($this->analyzer['test_id'], 7);
        $this->analyzer['pm_7'] = $this->getPercent($this->analyzer['cm_7']);
        $this->analyzer['cm_6'] = Cards::countMembersWithRange($this->analyzer['test_id'], 6);
        $this->analyzer['pm_6'] = $this->getPercent($this->analyzer['cm_6']);
        $this->analyzer['cm_5'] = Cards::countMembersWithRange($this->analyzer['test_id'], 5);
        $this->analyzer['pm_5'] = $this->getPercent($this->analyzer['cm_5']);
        $this->analyzer['cm_4'] = Cards::countMembersWithRange($this->analyzer['test_id'], 4);
        $this->analyzer['pm_4'] = $this->getPercent($this->analyzer['cm_4']);
        $this->analyzer['cm_3'] = Cards::countMembersWithRange($this->analyzer['test_id'], 3);
        $this->analyzer['pm_3'] = $this->getPercent($this->analyzer['cm_3']);
        $this->analyzer['cm_2'] = Cards::countMembersWithRange($this->analyzer['test_id'], 2);
        $this->analyzer['pm_2'] = $this->getPercent($this->analyzer['cm_2']);
        $this->analyzer['cm_1'] = Cards::countMembersWithRange($this->analyzer['test_id'], 1);
        $this->analyzer['pm_1'] = $this->getPercent($this->analyzer['cm_1']);

        $this->prepareAverageRanges();
    }

    protected function getPercent(int $part = 0)
    {
        if ($this->analyzer['count_members'] > 0) {
            if ($part > 0) {
                $result = $part / $this->analyzer['count_members'] * 100;
                return round($result, 2);
            }
        }

        return 0;
    }

    protected function prepareAverageRanges(): void
    {
        $total = 0;
        foreach ($this->analyzer as $key => $value) {
            if (strpos($key, 'cm_') !== false) {
                switch ($key) {
                    case 'cm_10': $total = $this->getAVG($total, 10, $value); break;
                    case 'cm_9': $total = $this->getAVG($total, 9, $value); break;
                    case 'cm_8': $total = $this->getAVG($total, 8, $value); break;
                    case 'cm_7': $total = $this->getAVG($total, 7, $value); break;
                    case 'cm_6': $total = $this->getAVG($total, 6, $value); break;
                    case 'cm_5': $total = $this->getAVG($total, 5, $value); break;
                    case 'cm_4': $total = $this->getAVG($total, 4, $value); break;
                    case 'cm_3': $total = $this->getAVG($total, 3, $value); break;
                    case 'cm_2': $total = $this->getAVG($total, 2, $value); break;
                    case 'cm_1': $total = $this->getAVG($total, 1, $value); break;
                }
            }
        }

        $this->analyzer['average_range'] = 0; // значение по-умолчанию

        if ($total > 0) {
            if ($this->analyzer['count_members'] > 0) {
                $this->analyzer['average_range'] = ceil($total / $this->analyzer['count_members']);
            }
        }
    }

    protected function getAVG(int $total, int $range, int $value = 0)
    {
        if ($value > 0) {
            return $total + ($range * $value);
        }

        return $total;
    }

    protected function countRangeLevels(): void
    {
        $this->countLevel('high', [10, 9]);
        $this->analyzer['percentage_level_high'] = $this->getPercent(
            $this->analyzer['count_level_high']
        );
        $this->countLevel('enough', [8, 7]);
        $this->analyzer['percentage_level_enough'] = $this->getPercent(
            $this->analyzer['count_level_enough']
        );
        $this->countLevel('middle', [6, 5]);
        $this->analyzer['percentage_level_middle'] = $this->getPercent(
            $this->analyzer['count_level_middle']
        );
        $this->countLevel('satisfying', [4, 3]);
        $this->analyzer['percentage_level_satisfying'] = $this->getPercent(
            $this->analyzer['count_level_satisfying']
        );
        $this->countLevel('low', [2, 1]);
        $this->analyzer['percentage_level_low'] = $this->getPercent(
            $this->analyzer['count_level_low']
        );
    }

    protected function countLevel(string $level, array $ranges): void
    {
        $levelName = 'count_level_' . $level;
        $this->analyzer[$levelName] = 0;
        foreach ($this->analyzer as $key => $value) {
            if (strpos($key, 'cm_') !== false) {
                list($prefix, $range) = explode('_', $key);
                if (in_array($range, $ranges) && $value > 0) {
                    $this->analyzer[$levelName]++;
                }
            }
        }
    }
}
