<?php

namespace App\Http\Controllers;

use App\Http\Models\EducationalInstitution;
use App\Http\Models\Teacher;
use Illuminate\Support\Facades\Auth;

class SettingsController extends MainController
{
    public function index()
    {
        if (Auth::guest()) {
            return view('welcome');
        }

        return view('settings.index');
    }

    public function dicts_index()
    {
        if (Auth::guest()) {
            return view('welcome');
        }

        return view('settings.dicts.index');
    }






















}
