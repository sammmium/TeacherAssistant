<?php

namespace App\Http\Models;

use App\Http\Interfaces\EducationalInstitutionInterface;

class EducationalInstitution extends TEI implements EducationalInstitutionInterface
{
    protected $table = 'educational_institutions';

    public $timestamps = false;

    protected $fillable = ['full_name', 'short_name', 'address'];

    public function getEducationalInstitutionById(int $educationalInstitutionId = null): array
    {
        if (is_null($educationalInstitutionId)) {
            return [];
        }

        $sql = "
            select *
            from educational_institutions
            where id = :eId
            limit 1
        ";
        $params = ['eId' => $educationalInstitutionId];
        $rawData = $this->getRawData($sql, $params);

        return $this->getPreparedData($rawData);
    }

    public function getEducationalInstitutionByUserId(int $userId): array
    {
        $sql = "
            select *
            from educational_institutions
            where id = (
                select educational_institution_id
                from teachers
                where user_id = :userId
            )
            limit 1
        ";
        $params = ['userId' => $userId];
        $rawData = $this->getRawData($sql, $params);
        return $this->getPreparedData($rawData);
    }

    public function check(int $userId = null): bool
    {
        $ei = $this->getEducationalInstitutionByUserId($userId);

        if (empty($ei)) return false;

        /*
         'educationalInstitution' =>
              'id' => int 1
              'full_name' => string 'Гимназия 2' (length=18)
              'short_name' => string 'Г2' (length=3)
              'address' => string 'Минск' (length=10)
              'city_id' => int 1
         */
        $requireFields = [
            'full_name',
            'short_name',
        ];

        foreach ($requireFields as $field) {
            if (empty($ei[$field])) return false;
        }

        return true;
    }

    public function getEducationalInstitutionList(): array
    {
        $sql = "
            select *
            from educational_institutions
            order by asc
            limit 50
        ";
        $rawData = $this->getRawData($sql);

        return $this->getPreparedData($rawData);
    }

//    public function updateEducationalInstitution(int $userId, array $options = []): void
//    {
//        if (!count($options)) return;
//
////        $teacher = new Teacher();
////        $teacherData = $teacher->getTeacher($userId);
////        $eiId = $teacherData[''];
//
//        $sepatator = ', ';
//        $arrayOptions = [];
//        foreach ($options as $key => $value) {
//            $arrayOptions[] = "$key = '$value'";
//        }
//        $stringOptions = implode($sepatator, $arrayOptions);
//
//        $sql = "update educational_institutions set $stringOptions where ";
//
//        var_dump($userId, $options, $sql);exit;
//    }
}
