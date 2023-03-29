<?php

namespace App\Http\Models;

use App\Http\Traits\Helper;
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

    public static function getPupilList(array $params): array
    {
        return self::prepare(DB::table('units_groups_pupils as ugp')
            ->select([
                'ugp.id as id',
                'p.id as pupil_id',
                'p.lastname as lastname',
                'p.firstname as firstname',
                'p.patronymic as patronymic'
            ])
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

    use Helper;

    public static function getFullPupilList(array $params): array
    {
        $result = [];
        $pupils = self::prepare(DB::table('units_groups_pupils as ugp')
            ->select([
                'ugp.id as id',
                'ugp.pupil_id as pupil_id',
                'p.lastname as lastname',
                'p.firstname as firstname',
                'p.patronymic as patronymic',
                'p.birthdate as birthdate',
                'p.description as description',
                'd.value as role'
            ])
            ->leftJoin('people as p', 'ugp.pupil_id', '=', 'p.id')
            ->leftJoin('dicts as d', 'p.role_id', '=', 'd.id')
            ->where([
                'ugp.unit_group_id' => $params['unit_group_id'],
                'p.role_id' => DB::raw("(select d.id from dicts as d where d.code = 'pupil')")
            ])
            ->orderBy('p.lastname')
            ->get(),

            true
        );
        if (count($pupils)) {
            foreach ($pupils as $pupil) {
                $fio = parent::getFIO($pupil);
                $result[] = [
                    'id' => $pupil['pupil_id'],
                    'fio' => $fio,
                    'birthdate' => self::transformDate($pupil['birthdate'], 'ru'),
                    'description' => !empty($pupil['description']) ? $pupil['description'] : '',
                    'role' => $pupil['role']
                ];
            }
        }

        return $result;
    }

    public static function getGroupId(int $pupilId): array
    {
        return self::prepare(DB::table('units_groups as ug')
            ->select(['ug.group_id as id'])
            ->leftJoin('units_groups_pupils as ugp', 'ug.id', '=', 'ugp.unit_group_id')
            ->where([
                'ugp.pupil_id' => $pupilId
            ])
            ->get()
        );
    }

    public static function getId(array $params): array
    {
        return self::prepare(DB::table('units_groups_pupils')
            ->select(['id'])
            ->where('pupil_id', '=', $params['pupil_id'])
            ->where('unit_group_id', '=', $params['unit_group_id'])
            ->get()
        );
    }

    public static function getPupil(int $id): array
    {
        return self::prepare(DB::table('units_groups_pupils')
            ->select('pupil_id')
            ->where('id', '=', $id)
            ->get()
        );
    }

    public static function getCountPupils(int $unitGroupId): int
    {
        return DB::table('units_groups_pupils')
            ->where('unit_group_id', '=', $unitGroupId)
            ->groupBy('unit_group_id')
            ->count('pupil_id');
    }
}
