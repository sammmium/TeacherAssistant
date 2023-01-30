<?php

namespace App\Http\Controllers;

use App\Http\Models\Core;
use App\Http\Models\CoreData;
use App\Http\Models\EducationalInstitution;
use App\Http\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
//        Log::emergency('Starting');
        if (Auth::guest()) {
            return view('welcome');
        }

        if (!Core::check()) {
            return redirect()
                ->route('settings');
        }

        /*
         * готовим список групп
         * если группа выбрана, то сохраняем ее в сессию
         * добавление в сессию возможно только после ее наполнения хотя бы одним учеником
         * если в ней еще нет учеников, то перенаправляем пользователя в форму заполнения группы учениками
         */

        /*
         * если в сессии сохранена группа, то готовим список контрольных
         */

        /*
          'teacher' =>
              'id' => int 1
              'first_name' => string 'Татьяна' (length=14)
              'last_name' => string 'Самойлова' (length=18)
              'user_id' => int 1
              'role_id' => int 1
              'subject_id' => int 1
              'educational_institution_id' => int 1
          'educationalInstitution' =>
              'id' => int 1
              'full_name' => string 'Гимназия 2' (length=18)
              'short_name' => string 'Г2' (length=3)
              'address' => string 'Минск' (length=10)
              'city_id' => int 1


        25
        ГУО «Гимназия № 2 г. Минска»
        ул. Никифорова, 37
        тел: 348-55-86
        gymn2@minsk.edu.by
        gymn2.minsk.edu.by


         */

        return view('home', []);
    }
}
