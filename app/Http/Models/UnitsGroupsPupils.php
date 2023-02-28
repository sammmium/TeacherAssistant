<?php

namespace App\Http\Models;

use Illuminate\Support\Facades\DB;

class UnitsGroupsPupils extends BaseModel
{
    protected $table = 'units_groups_pupils';

    protected $fillable = [
        'unit_group_id',
        'pupil_id'
    ];

    public $timestamps = false;

    public static function has(array $params): bool
    {
        return (bool)DB::table('units_groups_pupils')
            ->where($params)
            ->count('id');
    }

    public static function getPupilList(array $params)
    {
        return self::prepare(DB::table('units_groups_pupils as ugp')
            ->select(['ugp.id as id', 'p.lastname as lastname', 'p.firstname as firstname', 'p.patronymic as patronymic'])
            ->leftJoin('people as p', 'ugp.pupil_id', '=', 'p.id')
            ->where([
                'ugp.unit_group_id' => $params['unit_group_id'],
                'p.role_id' => DB::raw("(select d.id from dicts as d where d.code = 'pupil')")
            ])
            ->orderBy('p.lastname')
            ->get(),
            true
        );
    }
}
