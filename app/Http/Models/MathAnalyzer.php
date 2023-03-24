<?php

namespace App\Http\Models;

use App\Http\Traits\Helper;
use Illuminate\Support\Facades\Auth;

class MathAnalyzer extends Analyzer
{

    public function __construct(array $attributes = [])
    {
        $this->analyzer['group_id'] = (int)$attributes['group_id'];
        $this->analyzer['subject_id'] = (int)$attributes['subject_id'];
        $this->analyzer['test_id'] = (int)$attributes['test_id'];
    }

    use Helper;

    public function getAnalyzedData(): array
    {
        $this->prepareMainData();
        $this->prepareCountPupils();
        $this->prepareCountMembers();
        $this->prepareRanges();
        $this->countRangeLevels();


//        var_dump($this->analyzer);exit;
        return $this->analyzer;
    }

    private function prepareMainData(): void
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

    private function prepareCountPupils(): void
    {
        $this->analyzer['count_pupils'] = UnitsGroupsPupils::getCountPupils(
            $this->analyzer['unit_group_id']
        );
    }

    private function prepareCountMembers(): void
    {
        $this->analyzer['count_members'] = Cards::getCountMembers(
            $this->analyzer['test_id']
        );
    }
}
