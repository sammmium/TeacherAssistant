<?php

namespace App\Http\Models;

use App\Http\Interfaces\EducationalInstitutionInterface;
use Illuminate\Support\Facades\DB;

class EducationalInstitution extends TEI implements EducationalInstitutionInterface
{
    protected $table = 'educational_institutions';

    public $timestamps = false;

    protected $fillable = [
        'fullname',
        'shortname',
        'address'
    ];

    public static function getEducationalInstitution(array $params): array
    {
        return self::prepare(
            DB::table('educational_institutions')
                ->select('*')
                ->where($params)
                ->get()
        );
    }

    public static function check(int $teacherId): bool
    {
        $unit = Unit::getUnit($teacherId, date('Y'));

        if (is_null($unit['educational_institution_id'])) {
            return false;
        }

        return true;
    }

    public static function getEducationalInstitutionList(): array
    {
        return self::prepare(
            DB::table('educational_institutions')
                ->select('*')
                ->orderBy('fullname')
                ->get(),
            true
        );
    }
}
