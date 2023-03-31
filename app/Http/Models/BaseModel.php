<?php

namespace App\Http\Models;

use App\Http\Traits\Helper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
	use Helper;

    public static function init()
    {
        if (Auth::user()) {
            return Auth::user()->id;
        }

        return null;
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
}
