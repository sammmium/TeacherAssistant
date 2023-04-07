<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\DB;

/**
 * Имеет следующие функции:
 * - transformDate
 * - getFIO
 */
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

    protected static function cutGroupNumber(string $groupName): int
    {
        if (strpos($groupName, '_') !== false) {
            $parts = explode('_', $groupName);
            return $parts[1];
        }

        return $groupName;
    }

    protected static function prepare($rawData, bool $list = false): array
    {
        $result = [];

        if (!empty($rawData)) {
            foreach ($rawData as $item) {
                $result[] = self::prepareItem($item);
            }
        }

        if ($list) return $result;

        if (count($result) == 0) return $result;

        return $result[0];
    }

    protected static function prepareItem($item): array
    {
        $result = [];
        foreach ($item as $key => $value) {
            $result[$key] = $value;
        }

        return  $result;
    }

    /**
     * Получение необработанного результата выборки данных
     *
     * @param string $sql
     * @param array $params
     * @return array
     */
    protected function getRawData(string $sql, array $params = []): array
    {
        return DB::select($sql, $params);
    }

    protected static function transformTestType(string $testType): array
    {
        list($sub, $type) = explode('_', $testType);

        return compact('sub', 'type');
    }

    protected static function gatherTestType(string $sub, string $type): string
    {
        return $sub . '_' . $type;
    }
}
