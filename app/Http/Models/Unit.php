<?php

namespace App\Http\Models;

use App\Http\Interfaces\EducationalInstitutionInterface;
use App\Http\Interfaces\TeacherInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Unit extends BaseModel
{
    protected $table = 'units';

    protected $fillable = [
        'year',
        'teacher_id',
        'educational_institution_id'
    ];

    public $timestamps = false;

    public static function initUnit(int $teacherId, string $year = null): void
    {
        if (is_null($year)) {
            $year = date('Y');
        }

        if (!self::hasUnit($teacherId, $year)) {
            self::createUnit($teacherId, $year);
        }
    }

    public static function hasUnit(int $teacherId, string $year, int $educationalInstitutionId = null): bool
    {
        $input = [
            'year' => $year,
            'teacher_id' => $teacherId
        ];
        if (!is_null($educationalInstitutionId)) {
            $input['educational_institution_id'] = $educationalInstitutionId;
        }
        return (bool)DB::table('units')
            ->where($input)
            ->count();
    }

    public static function isFilledUnit(int $teacherId): bool
    {
        $input = "`year` = '" . date('Y') . "' and `teacher_id` = '$teacherId' and `educational_institution_id` is not null";

        return (bool)DB::table('units')
            ->whereRaw($input)
            ->count();
    }

    public static function createUnit(int $teacherId, string $year): void
    {
        self::create(['year' => $year, 'teacher_id' => $teacherId]);
    }

    public static function getUnit(int $teacherId, string $year)
    {
        return self::prepare(DB::table('units')
            ->select('*')
            ->where(['year' => $year, 'teacher_id' => $teacherId])
            ->get()
        );
    }

    public static function check(): bool
    {
//        parent::init();
        if (!self::checkTeacher(new Teacher())) return false;
//        if (!self::checkEducationalInstitution(new EducationalInstitution())) return false;
        return true;
    }


    /**
     * Проверка заполненности данными записи об учебном заведении
     *
     * @return bool
     */
    public static function checkEducationalInstitution(int $teacherId): bool
    {
//        var_dump(EducationalInstitution::check($teacherId));exit;
        return EducationalInstitution::check($teacherId);
    }

    /**
     * Проверка заполненности данными записи об учителе
     *
     * @return bool
     */
    public static function checkTeacher(): bool
    {
        return Teacher::check();
    }
}
