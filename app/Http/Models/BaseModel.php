<?php

namespace App\Http\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    public static function init()
    {
        if (Auth::user()) {
            return Auth::user()->id;
        }

        return null;
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

    /**
     * Преобразование массива stdClass объектов в массив
     * ассоциативных массивов или в один ассоциативный массив.
     *
     * @param $rawData
     * @param bool $list
     * @return array
     */
    protected function getPreparedData($rawData, bool $list = false): array
    {
        if (!empty($rawData)) {
            $result = [];
            foreach ($rawData as $rawItem) {
                $result[] = $this->getPreparedItem($rawItem);
            }

            return (count($result) > 1) ? $result : ($list ? $result : $result[0]);
        }

        return [];
    }

    /**
     * Преобразование stdClass объекта в ассоциативный массив
     *
     * @param $item
     * @return array
     */
    protected function getPreparedItem($item): array
    {
        $result = [];
        foreach ($item as $key => $value) {
            $result[$key] = $value;
        }

        return $result;
    }

    protected function updateItem($sql): void
    {

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

    protected static function getFIO(array $person): string
    {
        $separator = ' ';
        $result = !empty($person['lastname']) ? $person['lastname'] . $separator : '';
        $result .= !empty($person['firstname']) ? $person['firstname'] . $separator : '';
        $result .= !empty($person['patronymic']) ? $person['patronymic'] : '';
        return $result;
    }




}
