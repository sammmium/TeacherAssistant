<?php

namespace App\Http\Models;

use Illuminate\Support\Facades\DB;

class Cards extends BaseModel
{
    protected $table = 'cards';

    protected $fillable = [
        'test_id',
        'unit_group_pupil_id',
    ];

    public $timestamps = false;

    /**
     * Выборка списка карточек учеников.
     *
     * @param array $params
     * @return array
     */
    public static function getCardList(array $params): array
    {
        return self::prepare(DB::table('cards')
            ->select('*')
            ->where($params)
            ->get(),
            true
        );
    }

    /**
     * Проверка наличия карточки ученика.
     *
     * @param array $params
     * @return bool
     */
    public static function has(array $params): bool
    {
        return (bool)DB::table('cards')
            ->where($params)
            ->count('id');
    }

    /**
     * Выборка участников контрольной работы.
     *
     * @param int $testId
     * @param int $ugpId
     * @return array
     */
    public static function getSelectedMember(int $testId, int $ugpId): array
    {
        return self::prepare(DB::table('cards as c')
            ->select([
                'c.id as id',
                'c.unit_group_pupil_id as ugpid',
                'p.lastname as lastname',
                'p.firstname as firstname',
                'p.patronymic as patronymic',
                DB::raw("(select count(t.id) from card_values as t where t.card_id = c.id) as filled")
            ])
			->leftJoin('units_groups_pupils as ugp', 'c.unit_group_pupil_id', '=', 'ugp.id')
            ->leftJoin('people as p', 'ugp.pupil_id', '=', 'p.id')
            ->where([
                'c.test_id' => $testId,
				'c.unit_group_pupil_id' => $ugpId
            ])
            ->get()
        );
    }

    /**
     * Получение идентификатора карточки ученика.
     *
     * @param array $params
     * @return array
     */
    public static function getId(array $params): array
    {
        if (!self::has($params)) {
            self::create($params);
        }
        return self::prepare(DB::table('cards')
            ->select(['id'])
            ->where('test_id', '=', $params['test_id'])
            ->where('unit_group_pupil_id', '=', $params['unit_group_pupil_id'])
            ->get()
        );
    }

    /**
     * Создание карточки ученика.
     *
     * @param array $params
     * @return void
     */
    public static function create(array $params): void
    {
        DB::table('cards')->insert($params);
    }

    public static function getCountMembers(int $testId): int
    {
        return DB::table('cards')
            ->where('test_id', '=', $testId)
            ->count('unit_group_pupil_id');
    }

    public static function countMembersWithRange(int $testId, int $range): int
    {
        return DB::table('cards as c')
            ->leftJoin('card_values as cv', 'c.id', '=', 'cv.card_id')
            ->leftJoin('dicts as d', 'cv.dict_id', '=', 'd.id')
            ->where('c.test_id', '=', $testId)
            ->where('d.code', '=', 'range')
            ->where('cv.value', '=', $range)
            ->count('c.id');
    }
}
