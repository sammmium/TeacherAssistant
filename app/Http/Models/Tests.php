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
        'unit_group_id',
        'type',
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

    public static function getThemeOptions(array $params): array
    {
        $result = self::prepare(DB::table('tests')
            ->select('*')
            ->where($params)
            ->orderBy('name')
            ->get(),
            true
        );

        $options = [
            0 => 'Выберите тему'
        ];
        foreach ($result as $item) {
            $options[$item['id']] = $item['name'];
        }

        return $options;
    }

    public static function getLastInsertId(array $options)
    {
        return self::lastInsertId('tests', $options);
    }
}
