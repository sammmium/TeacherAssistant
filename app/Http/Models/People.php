<?php

namespace App\Http\Models;

use Illuminate\Support\Facades\DB;

class People extends BaseModel
{
    public static function getPeopleList(array $idList, string $role = 'pupil'): array
    {
        return self::prepare(DB::table('people')
            ->select(['firstname', 'lastname', 'patronymic'])
            ->where('role_id', '=', $role)
            ->whereIn('id', $idList)
            ->get(),
            true
        );
    }
}
