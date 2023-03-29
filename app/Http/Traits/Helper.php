<?php

namespace App\Http\Traits;

trait Helper
{
    protected static function transformDate(string $date, string $to): string
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

    protected static function getFIO(array $person): string
    {
        $separator = ' ';
        $result = !empty($person['lastname']) ? $person['lastname'] : '';
        $result .= !empty($person['firstname']) ? $separator . $person['firstname'] : '';
        $result .= !empty($person['patronymic']) ? $separator . $person['patronymic'] : '';
        return $result;
    }
}
