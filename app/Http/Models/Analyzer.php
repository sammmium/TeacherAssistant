<?php

namespace App\Http\Models;

use App\Http\Interfaces\AnalyzerInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Analyzer extends BaseModel implements AnalyzerInterface
{
    protected $analyzer = [];

    public function getAnalyzedData(): array
    {
        return [];
    }

    protected function prepareMainData(): void
    {
        $subject = Dicts::getById($this->analyzer['subject_id']);
        $sub = $subject['code'];
        $group = Dicts::getById($this->analyzer['group_id']);
        $test = Tests::getTest(['id' => $this->analyzer['test_id']]);
        $ws = WorkStatus::get(Auth::user()->id);
        $this->analyzer['unit_group_id'] = $ws['unit_group_id'];
        $unitTeacher = Unit::getTeacherId($ws);
        $this->analyzer['teacher'] = Teacher::getTeacherFio(['id' => $unitTeacher['teacher_id']]);
        $this->analyzer['group'] = $group['value'];
        $this->analyzer['theme'] = $test['name'];
        $this->analyzer['date'] = self::transformDate($test['date'], 'ru');
        list($prefix, $number, $letter) = explode('_', $group['code']);
        $this->analyzer['template_file_name'] = $sub . '_' . $number . '.docx';
    }

    protected function prepareCountPupils(): void
    {
        $this->analyzer['count_pupils'] = UnitsGroupsPupils::getCountPupils(
            $this->analyzer['unit_group_id']
        );
    }

    protected function prepareCountMembers(): void
    {
        $this->analyzer['count_members'] = Cards::getCountMembers(
            $this->analyzer['test_id']
        );
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
