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

    protected function transformDate(string $date, string $to): string
    {
        $separatorRu = '.';
        $separatorEn = '-';
        if ($to == 'en') {
            if (strpos($date, $separatorRu) !== false) {
                list($d, $m, $y) = explode($separatorRu, $date);
                return $y . $separatorEn . $m . $separatorEn . $d;
            }
        } else {
            if (strpos($date, $separatorEn) !== false) {
                list($y, $m, $d) = explode($separatorEn, $date);
                return $d . $separatorRu . $m . $separatorRu . $y;
            }
        }
        return $date;
    }
}
