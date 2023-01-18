<?php

namespace App\Http\Models;

use Illuminate\Support\Facades\DB;

use \Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    /**
     * Получение необработанного результата выборки одной строки
     *
     * @param string $sql
     * @param array $params
     * @return array
     */
    protected function getRawRow(string $sql, array $params)
    {
        return DB::select($sql, $params);
    }

    /**
     * Преобразование массива stdClass объектов в массив
     * ассоциативных массивов или в один ассоциативный массив.
     *
     * @param $rawData
     * @return array|mixed
     */
    protected function getPreparedData($rawData, bool $list = false)
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
    protected function getPreparedItem($item)
    {
        $result = [];
        foreach ($item as $key => $value) {
            $result[$key] = $value;
        }

        return $result;
    }
}
