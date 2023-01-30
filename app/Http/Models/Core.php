<?php

namespace App\Http\Models;

use App\Http\Interfaces\EducationalInstitutionInterface;
use App\Http\Interfaces\TeacherInterface;
use Illuminate\Support\Facades\Auth;

class Core extends BaseModel
{

    /**
     * Проверка заполненности основных данных
     *
     * @return bool
     */
    public static function check(): bool
    {
        parent::init();
        if (!self::checkTeacher(new Teacher())) return false;
        if (!self::checkEducationalInstitution(new EducationalInstitution())) return false;
        return true;
    }

    /**
     * Проверка заполненности данными записи об учебном заведении
     *
     * @param EducationalInstitutionInterface $ei
     * @return bool
     */
    public static function checkEducationalInstitution(EducationalInstitutionInterface $instance): bool
    {
        $userId = parent::init();
        return $instance->check($userId);
    }

    /**
     * Проверка заполненности данными записи об учителе
     *
     * @param TeacherInterface $instance
     * @return bool
     */
    public static function checkTeacher(TeacherInterface $instance): bool
    {
        $userId = parent::init();
        return $instance->check($userId);
    }
}
