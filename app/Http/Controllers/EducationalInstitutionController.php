<?php

namespace App\Http\Controllers;

use App\Http\Models\EducationalInstitution;
use App\Http\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EducationalInstitutionController extends Controller
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
        if (Auth::guest()) {
            return view('welcome');
        }

        $teacher = new Teacher();
        if (!$teacher->check(Auth::user()->id)) {
            return redirect('teacher');
        }

        $instance = new EducationalInstitution();
        $educationalInstitution = $instance->getEducationalInstitutionByUserId(Auth::user()->id);
        if (count($educationalInstitution)) {
            $input['educational_institution'] = $educationalInstitution;
            return view('educational_institution.index', $input);
        }
        return view('educational_institution.create');
    }

    public function edit()
    {
        if (Auth::guest()) {
            return view('welcome');
        }

        $instance = new EducationalInstitution();
        $educationalInstitution = $instance->getEducationalInstitutionByUserId(Auth::user()->id);

        return view('educational_institution.edit', $educationalInstitution);
    }

    public function store(Request $request)
    {
        if (Auth::guest()) {
            return view('welcome');
        }

        EducationalInstitution::where('id', $request['educational_institution_id'])
            ->update([
                'full_name' => $request['full_name'],
                'short_name' => $request['short_name'],
                'address' => $request['address']
            ]);

        return redirect('educational_institution');
    }

    public function add(Request $request)
    {
        if (Auth::guest()) {
            return view('welcome');
        }

        $input = [
            'full_name' => $request['full_name'],
            'short_name' => $request['short_name'],
            'address' => $request['address'],
            'user_id' => Auth::user()->id
        ];

        $educationalInstitution = EducationalInstitution::create($input);

        if ($educationalInstitution) {
            Teacher::where('user_id', Auth::user()->id)
                ->update([
                    'educational_institution_id' => $educationalInstitution->id
                ]);
        }

        return redirect('educational_institution');
    }

    public function create()
    {
        if (Auth::guest()) {
            return view('welcome');
        }

        return view('educational_institution.create');
    }
}
