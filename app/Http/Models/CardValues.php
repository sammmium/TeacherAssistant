<?php

namespace App\Http\Models;

use Illuminate\Support\Facades\DB;

class CardValues extends BaseModel
{
    protected $table = 'card_values';

    protected $fillable = [
        'card_id',
        'dict_id',
        'value',
    ];

    public $timestamps = false;

    /**
     * Проверка наличия записей в карточке ученика.
     *
     * @param array $params
     * @return bool
     */
    public static function has(array $params): bool
    {
        return (bool)DB::table('card_values')
            ->where($params)
            ->count('id');
    }

    /**
     * Удаление всех записей по карточке ученика.
     *
     * @param int $cardId
     * @return void
     */
    public static function deleteItem(int $cardId): void
    {
        if (self::has(['card_id' => $cardId])) {
            DB::table('card_values')->where([
                'card_id' => $cardId
            ])->delete();
        }
    }

    /**
     * Создание записей по карточке ученика.
     *
     * @param array $params
     * @return void
     */
    public static function create(array $params): void
    {
        DB::table('card_values')->insert($params);
    }

    /**
     * Массив данных по карточке ученика.
     * Формат данных: [code => value[, ...]]
     *
     * @param int $cardId
     * @return array
     */
    public static function getValues(int $cardId): array
    {
        $values = self::prepare(DB::table('card_values as cv')
            ->select(['d.code as code', 'cv.value as value'])
            ->leftJoin('dicts as d', 'cv.dict_id', '=', 'd.id')
            ->where('cv.card_id', '=', $cardId)
            ->get(),

            true
        );

        $result = [];

        if (count($values)) {
            foreach ($values as $item) {
                $result[$item['code']] = $item['value'];
            }
        }

        return $result;
    }
}
