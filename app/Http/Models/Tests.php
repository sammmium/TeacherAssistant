<?php

namespace App\Http\Models;

use Illuminate\Support\Facades\DB;

class Tests extends BaseModel
{
    protected $table = 'tests';

    protected $fillable = [
        'name',
        'date',
        'unit_subject_id',
    ];

    public $timestamps = false;

    public static function getTest(array $params): array
    {
        return self::prepare(DB::table('tests')
            ->select('*')
            ->where($params)
            ->get()
        );
    }

    public static function getTestList(int $unitSubjectId): array
    {
        return self::prepare(DB::table('tests')
            ->select('*')
            ->where([
                'unit_subject_id' => $unitSubjectId,
            ])
            ->orderBy('name')
            ->get(),
            true
        );
    }

    public static function has(array $params): bool
    {
        return (bool)DB::table('tests')
            ->where($params)
            ->count('id');
    }
}
