<?php

namespace App\Http\Controllers;

use \App\Http\Models\EducationalInstitution;
use App\Http\Models\Teacher;
use App\Http\Models\TEI;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tei = new Teacher();
        $res = $tei->getTeacher(2);

        $tei = new Teacher();
        $sch = $tei->getSchool(1);

        var_dump($sch);exit;

        $school = new EducationalInstitution();
        if (!$school->hasBaseData()) {
            redirect('/school/add');
            exit;
        }
        //
        // return view('home', ['school' => ['name' => 'Gymnasia 2']]);
        return view('home');
    }
}
