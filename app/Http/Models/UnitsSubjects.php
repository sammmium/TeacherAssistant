<?php

namespace App\Http\Models;

use Illuminate\Support\Facades\DB;

class UnitsSubjects extends BaseModel
{
    protected $table = 'units_subjects';

    protected $fillable = [
        'unit_group_id',
        'subject_id'
    ];

    public $timestamps = false;

    public static function has(array $params): bool
    {
        return (bool)DB::table('units_subjects')
            ->where($params)
            ->count('id');
    }

    public static function getSubjectList(array $params): array
    {
        return self::prepare(DB::table('units_subjects')
            ->select(['dicts.id as id', 'dicts.value as name'])
            ->leftJoin('dicts', 'units_subjects.subject_id', '=', 'dicts.id')
            ->where([
                'units_subjects.unit_group_id' => $params['unit_group_id']
            ])
            ->orderBy('dicts.value')
            ->get(),
            true
        );
    }

    public static function getUnitSubject(array $params): array
    {
        return self::prepare(DB::table('units_subjects')
            ->select('*')
            ->where($params)
            ->get()
        );
    }
}
