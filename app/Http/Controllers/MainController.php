<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public static function access()
    {
        if (Auth::guest()) {
            return view('welcome');
        }
    }

    public function fillParams(array $data, string $key, array $result = []): array
    {
        if (!empty($data[$key])) $result[$key] = $data[$key];

        return $result;
    }
}
