<?php

namespace App\Http\Controllers;

use App\Http\Models\EducationalInstitution;
use App\Http\Models\Teacher;
use App\Http\Models\Unit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EducationalInstitutionController extends MainController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        parent::access();

        if (!Teacher::check()) {
            return redirect()->route('teacher');
        }

        $educationalInstitutionList = EducationalInstitution::getEducationalInstitutionList();

        if (count($educationalInstitutionList)) {
            $teacher = Teacher::getTeacher();
            if (Unit::isFilledUnit($teacher['id'])) {
                $unit = Unit::getUnit($teacher['id'], date('Y'));
                $educationalInstitutionId = $unit['educational_institution_id'];
                $params = [
                    'id' => $educationalInstitutionId,
                ];
                $input['educational_institution'] = EducationalInstitution::getEducationalInstitution($params);
                return view('educational_institution.selected', $input);
            }
            $input['educational_institutions'] = $educationalInstitutionList;
            $input['teacher'] = $teacher;
            return view('educational_institution.select', $input);
        }

        return view('educational_institution.create');
    }

    public function selected(Request $request)
    {
        Unit::where([
            'year' => date('Y'),
            'teacher_id' => $request['teacher_id']
        ])->update([
            'educational_institution_id' => $request['educational_institution_id']
        ]);

        return redirect()->route('educational-institution');
    }

    public function reset(int $educationalInstitutionId)
    {
        $teacher = Teacher::getTeacher();
        Unit::where([
            'year' => date('Y'),
            'teacher_id' => $teacher['id'],
            'educational_institution_id' => $educationalInstitutionId
        ])->update([
            'educational_institution_id' => null
        ]);

        return redirect()->route('educational-institution');
    }

    public function edit(int $educationalInstitutionId)
    {
        parent::access();

        $params = [
            'id' => $educationalInstitutionId
        ];
        $input['educational_institution'] = EducationalInstitution::getEducationalInstitution($params);

        return view('educational_institution.edit', $input);
    }

    public function store(Request $request)
    {
        parent::access();

        EducationalInstitution::where('id', $request['educational_institution_id'])
            ->update([
                'fullname' => $request['fullname'],
                'shortname' => $request['shortname'],
                'address' => $request['address']
            ]);

        return redirect('educational_institution');
    }

    public function add(Request $request)
    {
        parent::access();

        $input = [
            'fullname' => $request['fullname'],
            'shortname' => $request['shortname'],
            'address' => $request['address'],
        ];

        $educationalInstitution = EducationalInstitution::create($input);

        if ($educationalInstitution) {
            $teacher = Teacher::getTeacher();
            Unit::where(['teacher_id' => $teacher['id']])
                ->update([
                    'educational_institution_id' => $educationalInstitution->id
                ]);
        }

        return redirect('educational_institution');
    }

    public function create()
    {
        parent::access();

        return view('educational_institution.create');
    }
}
