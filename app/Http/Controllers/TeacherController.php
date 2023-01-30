<?php

namespace App\Http\Controllers;

use App\Http\Models\Teacher;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TeacherController extends MainController
{
    public function index()
    {
        if (Auth::guest()) {
            return view('welcome');
        }

        $instance = new Teacher();
        $teacher = $instance->getTeacher(Auth::user()->id);
        if (count($teacher)) {
            $input['teacher'] = $teacher;
            return view('teacher.index', $input);
        }
        return view('teacher.create');
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
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'user_id' => Auth::user()->id,
            'job_title' => $request['job_title']
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
        return view('teacher.edit', $teacher);
    }

    public function store(Request $request)
    {
        if (Auth::guest()) {
            return view('welcome');
        }

        Teacher::where('id', $request['teacher_id'])
            ->update([
                'first_name' => $request['first_name'],
                'last_name' => $request['last_name'],
                'job_title' => $request['job_title']
            ]);

        return redirect('teacher');
    }
}
