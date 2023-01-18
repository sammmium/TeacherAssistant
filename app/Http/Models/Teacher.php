<?php

namespace App\Http\Models;

use Illuminate\Support\Facades\DB;

class Teacher extends TEI
{
    public function getTeacher(int $userId): array
    {
        $sql = "
            select *
            from teachers
            where user_id = :userId
            limit 1";
        $params = ['userId' => $userId];
        $rawData = $this->getRawRow($sql, $params);
        return $this->getPreparedData($rawData);
    }

    public function getSchool(int $userId): array
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
        $rawData = $this->getRawRow($sql, $params);
        return $this->getPreparedData($rawData);
    }

    public function getGroups(int $userId): array
    {


        return [];
    }
}
