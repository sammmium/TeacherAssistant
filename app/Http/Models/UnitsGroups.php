<?php

namespace App\Http\Models;

use Illuminate\Support\Facades\DB;

class UnitsGroups extends BaseModel
{
    protected $table = 'units_groups';

    protected $fillable = [
        'unit_id',
        'group_id'
    ];

    public $timestamps = false;

    public static function getGroupList(int $unitId): array
    {
        return self::prepare(DB::table('units_groups')
            ->select(['dicts.id as id', 'dicts.value as name'])
            ->leftJoin('dicts', 'units_groups.group_id', '=', 'dicts.id')
            ->where(['units_groups.unit_id' => $unitId])
            ->orderBy('dicts.value')
            ->get(),
            true
        );
    }

    public static function has(array $params): bool
    {
        return (bool)DB::table('units_groups')
            ->where($params)
            ->count('id');
    }

    public static function getUnitGroup(array $params): array
    {
        return self::prepare(DB::table('units_groups')
            ->select('*')
            ->where($params)
            ->get()
        );
    }
}
