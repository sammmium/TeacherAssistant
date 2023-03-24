<?php

namespace App\Http\Models;

use Illuminate\Support\Facades\DB;

class People extends BaseModel
{
    protected $table = 'people';

    protected $fillable = [
        'firstname',
        'lastname',
        'patronymic',
        'birthdate',
        'description',
        'role_id',
        'group_id',
    ];

    public $timestamps = false;

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

    public static function getPupil(int $id): array
    {
        return self::getPerson($id, 'pupil');
    }

    public static function getTeacher(int $id): array
    {
        return self::getPerson($id, 'teacher');
    }

    public static function getPerson(int $id, string $role): array
    {
        return self::prepare(DB::table('people as p')
            ->select([
                'p.firstname as firstname',
                'p.lastname as lastname',
                'p.patronymic as patronymic',
                'p.birthdate as birthdate',
                'd.value as role',
            ])
            ->leftJoin('dicts as d', 'p.role_id', '=', 'd.id')
            ->where('p.id', '=', $id)
            ->where('d.code', '=', $role)
            ->get()
        );
    }
}
