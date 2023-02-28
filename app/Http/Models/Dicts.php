<?php

namespace App\Http\Models;

use Illuminate\Support\Facades\DB;

class Dicts extends BaseModel
{
    protected $fillable = [
        'parent_id',
        'code',
        'value',
        'description'
    ];

    public $timestamps = false;

    /**
     * Инициализация (проверка и наполнение) таблицы
     *
     * @return void
     */
    private static function initDicts(): void
    {
        if (!self::has()) {
            self::fillCategories();
        }
    }

    /**
     * Проверка на заполненность таблицы данными
     *
     * @return bool
     */
    public static function has(): bool
    {
        return (bool)DB::table('dicts')
            ->count('id');
    }

    /**
     * Получение родительских записей из справочника
     *
     * @param string|null $code
     * @return \Illuminate\Support\Collection
     */
    public static function getDicts(string $code = null)
    {
        self::initDicts();

        $options = [
            'parent_id' => null
        ];
        if (!is_null($code)) {
            $options['code'] = $code;
        }

        return self::prepare(DB::table('dicts')
            ->select('*')
            ->where($options)
            ->get(),

            true
        );
    }

    /**
     * Получение дочерних записей из справочника
     * по коду их родителя
     *
     * @param string $code
     * @return \Illuminate\Support\Collection
     */
    public static function getOptions(string $code): array
    {
        self::initDicts();

        $subQueryOptions = [
            'parent_id' => null,
            'code' => $code
        ];

        return self::prepare(DB::table('dicts')
            ->select('*')
            ->where('parent_id', '=', function ($query) use ($subQueryOptions) {
                $query->select('id')
                    ->from('dicts')
                    ->where($subQueryOptions);
            })
            ->get(),
            true
        );
    }

    /**
     * Получение родительских или дочерних записей по их коду
     *
     * @param string $code
     * @return \Illuminate\Support\Collection
     */
    public static function getByCode(string $code):array
    {
        self::initDicts();

        return self::prepare(DB::table('dicts')
            ->select('*')
            ->where([
                'code' => $code
            ])
            ->get()
        );
    }

    /**
     * Получение родительских или дочерних записей по их идентификатору
     *
     * @param int $id
     * @return \Illuminate\Support\Collection
     */
    public static function getById(int $id): array
    {
        self::initDicts();

        return self::prepare(DB::table('dicts')
            ->select('*')
            ->where([
                'id' => $id
            ])
            ->limit(1)
            ->get()
        );
    }

    /**
     * Наполнение таблицы данными по-умолчанию
     *
     * @return void
     */
    private static function fillCategories(): void
    {
        $default = [
            ['parent_id' => null, 'code' => 'roles', 'value' => 'Роли'],
            ['parent_id' => null, 'code' => 'subjects', 'value' => 'Предметы'],
            ['parent_id' => null, 'code' => 'groups', 'value' => 'Классы'],

            ['parent_id' => 1, 'code' => 'pupil', 'value' => 'Ученик'],
            ['parent_id' => 1, 'code' => 'teacher', 'value' => 'Учитель начальных классов'],

            ['parent_id' => 2, 'code' => 'math', 'value' => 'Математика'],
            ['parent_id' => 2, 'code' => 'ruslang', 'value' => 'Русский язык'],
            ['parent_id' => 2, 'code' => 'bellang', 'value' => 'Белорусский язык'],
            ['parent_id' => 2, 'code' => 'ruslit', 'value' => 'Русская литература'],
            ['parent_id' => 2, 'code' => 'bellit', 'value' => 'Белорусская литература'],

            ['parent_id' => 3, 'code' => 'g1', 'value' => '1 класс'],
            ['parent_id' => 3, 'code' => 'g1a', 'value' => '1 "А" класс'],
            ['parent_id' => 3, 'code' => 'g1b', 'value' => '1 "Б" класс'],
            ['parent_id' => 3, 'code' => 'g2', 'value' => '2 класс'],
            ['parent_id' => 3, 'code' => 'g2a', 'value' => '2 "А" класс'],
            ['parent_id' => 3, 'code' => 'g2b', 'value' => '2 "Б" класс'],
            ['parent_id' => 3, 'code' => 'g3', 'value' => '3 класс'],
            ['parent_id' => 3, 'code' => 'g3a', 'value' => '3 "А" класс'],
            ['parent_id' => 3, 'code' => 'g3b', 'value' => '3 "Б" класс'],
            ['parent_id' => 3, 'code' => 'g4', 'value' => '4 класс'],
            ['parent_id' => 3, 'code' => 'g4a', 'value' => '4 "А" класс'],
            ['parent_id' => 3, 'code' => 'g4b', 'value' => '4 "Б" класс'],
            ['parent_id' => 3, 'code' => 'g5', 'value' => '5 класс'],
            ['parent_id' => 3, 'code' => 'g5a', 'value' => '5 "А" класс'],
            ['parent_id' => 3, 'code' => 'g5b', 'value' => '5 "Б" класс'],
            ['parent_id' => 3, 'code' => 'g6', 'value' => '6 класс'],
            ['parent_id' => 3, 'code' => 'g6a', 'value' => '6 "А" класс'],
            ['parent_id' => 3, 'code' => 'g6b', 'value' => '6 "Б" класс'],
            ['parent_id' => 3, 'code' => 'g7', 'value' => '7 класс'],
            ['parent_id' => 3, 'code' => 'g7a', 'value' => '7 "А" класс'],
            ['parent_id' => 3, 'code' => 'g7b', 'value' => '7 "Б" класс'],
            ['parent_id' => 3, 'code' => 'g8', 'value' => '8 класс'],
            ['parent_id' => 3, 'code' => 'g8a', 'value' => '8 "А" класс'],
            ['parent_id' => 3, 'code' => 'g8b', 'value' => '8 "Б" класс'],
            ['parent_id' => 3, 'code' => 'g9', 'value' => '9 класс'],
            ['parent_id' => 3, 'code' => 'g9a', 'value' => '9 "А" класс'],
            ['parent_id' => 3, 'code' => 'g9b', 'value' => '9 "Б" класс'],
            ['parent_id' => 3, 'code' => 'g10', 'value' => '10 класс'],
            ['parent_id' => 3, 'code' => 'g10a', 'value' => '10 "А" класс'],
            ['parent_id' => 3, 'code' => 'g10b', 'value' => '10 "Б" класс'],
            ['parent_id' => 3, 'code' => 'g11', 'value' => '11 класс'],
            ['parent_id' => 3, 'code' => 'g11a', 'value' => '11 "А" класс'],
            ['parent_id' => 3, 'code' => 'g11b', 'value' => '11 "Б" класс'],
        ];

        DB::table('dicts')
            ->insert($default);
    }
}
