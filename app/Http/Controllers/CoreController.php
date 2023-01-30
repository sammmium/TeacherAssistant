<?php

namespace App\Http\Controllers;

use App\Http\Models\Core;

class CoreController extends Controller
{
    public function index()
    {
        $_core = new Core();
        $coreRes = $_core->check();
    }
}
