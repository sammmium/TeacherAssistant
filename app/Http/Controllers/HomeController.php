<?php

namespace App\Http\Controllers;

use App\Http\Models\CoreData;
use App\Http\Models\EducationalInstitution;
use App\Http\Models\Teacher;
use App\Http\Models\TEI;
use Illuminate\Support\Facades\Auth;

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
        $user = Auth::user();
        $teacher = new Teacher();
        $educationalInstitution = new EducationalInstitution();
        $core = new CoreData($user, $teacher, $educationalInstitution);

        var_dump($core->getDataItem());exit;
//        $tei = new Teacher();
//        $res = $tei->getTeacher(2);
//        $sch = $tei->getSchool(1);


//        var_dump($user);exit;



//        var_dump($res, $sch);exit;

//        $school = new EducationalInstitution();
//        if (!$school->hasBaseData()) {
//            redirect('/school/add');
//            exit;
//        }
        //
        // return view('home', ['school' => ['name' => 'Gymnasia 2']]);
        return view('home');
    }
}
