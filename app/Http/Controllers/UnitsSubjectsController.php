<?php

namespace App\Http\Controllers;

use App\Http\Models\Dicts;
use App\Http\Models\Teacher;
use App\Http\Models\Unit;
use App\Http\Models\UnitsGroups;
use App\Http\Models\UnitsSubjects;
use App\Http\Models\WorkStatus;
use Illuminate\Http\Request;

class UnitsSubjectsController extends MainController
{
    public function subject_add()
    {
        $subjectList = Dicts::getOptions('subjects');
        $teacher = Teacher::getTeacher();
        $ws = WorkStatus::get($teacher['user_id']);
        $input = [
            'subject_list' => $subjectList,
            'unit_group_id' => $ws['unit_group_id'],
        ];

        return view('home.subject.add', $input);
    }

    public function selected(Request $request)
    {
        $this->validate($request, [
            'unit_group_id' => 'required|numeric',
            'subject_id' => 'required|numeric',
        ]);

        $input = [
            'unit_group_id' => (int)$request['unit_group_id'],
            'subject_id' => (int)$request['subject_id'],
        ];

        if (!UnitsSubjects::has($input)) {
            UnitsSubjects::create($input);
        }

        return redirect()->route('home');
    }

    public function subject_reset(Request $request)
    {
        $year = date('Y');
        $teacher = Teacher::getTeacher();
        $unit = Unit::getUnit($teacher['id'], $year);
        $unitGroup = UnitsGroups::getUnitGroup([
            'group_id' => (int)$request['group_id'],
            'unit_id' => (int)$unit['id'],
        ]);

        UnitsSubjects::where([
            'subject_id' => (int)$request['subject_id'],
            'unit_group_id' => (int)$unitGroup['id'],
        ])->delete();

        return redirect()->route('home');
    }
}
