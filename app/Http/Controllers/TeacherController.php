<?php

namespace App\Http\Controllers;

use App\Http\Models\Dicts;
use App\Http\Models\Teacher;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TeacherController extends MainController
{
    public function index()
    {
        parent::access();

        $teacher = Teacher::getTeacher();

        if (count($teacher)) {
            $input['teacher'] = $teacher;
            $input['teacher']['birthdate'] = $this->transformDate($input['teacher']['birthdate'], 'ru');
            $input['role'] = Dicts::getById($teacher['role_id']);

            return view('teacher.index', $input);
        }

        $dicts = Dicts::getOptions('roles');
        $input['dicts'] = $this->excludePupil($dicts);

        return view('teacher.create', $input);
    }

    private function excludePupil(array $input): array
    {
        $result = [];
        foreach ($input as $item) {
            if ($item['code'] !== 'pupil') {
                $result[] = $item;
            }
        }
        return $result;
    }

    public function create()
    {
        if (Auth::guest()) {
            return view('welcome');
        }

        return view('teacher.create');
    }

    public function add(Request $request)
    {
        if (Auth::guest()) {
            return view('welcome');
        }

        $input = [
            'lastname' => $request['lastname'],
            'firstname' => $request['firstname'],
            'patronymic' => $request['patronymic'],
            'birthdate' => $this->transformDate($request['birthdate'], 'en'),
            'user_id' => Auth::user()->id,
            'role_id' => (int)$request['role_id']
        ];

        Teacher::create($input);

        return redirect('teacher');
    }

    public function edit()
    {
        if (Auth::guest()) {
            return view('welcome');
        }

        $instance = new Teacher();
        $teacher = $instance->getTeacher(Auth::user()->id);

        $input['teacher'] = $teacher;
        $input['teacher']['birthdate'] = $this->transformDate($input['teacher']['birthdate'], 'ru');

        $dicts = Dicts::getOptions('roles');
        $input['roles'] = $dicts;

        return view('teacher.edit', $input);
    }

    public function store(Request $request)
    {
        if (Auth::guest()) {
            return view('welcome');
        }

        Teacher::where('id', $request['teacher_id'])
            ->update([
                'lastname' => $request['lastname'],
                'firstname' => $request['firstname'],
                'patronymic' => $request['patronymic'],
                'birthdate' => $this->transformDate($request['birthdate'], 'en'),
                'role_id' => (int)$request['role_id']
            ]);

        return redirect('teacher');
    }
}
