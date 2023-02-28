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

    public static function getCardList(array $params): array
    {
        return self::prepare(DB::table('cards')
            ->select('*')
            ->where($params)
            ->get(),
            true
        );
    }

    public static function has(array $params): bool
    {
        return (bool)DB::table('cards')
            ->where($params)
            ->count('id');
    }

    public static function getSelectedMember(int $testId, int $ugpId): array
    {
        return self::prepare(DB::table('cards as c')
            ->select(['c.id as id', 'c.unit_group_pupil_id as ugpid', 'p.lastname as lastname', 'p.firstname as firstname', 'p.patronymic as patronymic'])
			->leftJoin('units_groups_pupils as ugp', 'c.unit_group_pupil_id', '=', 'ugp.id')
            ->leftJoin('people as p', 'ugp.pupil_id', '=', 'p.id')
            ->where([
                'c.test_id' => $testId,
				'c.unit_group_pupil_id' => $ugpId
            ])
            ->get()
        );
    }
}
