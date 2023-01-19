<?php

namespace App\Http\Models;

use App\Http\Interfaces\TeacherInterface;
use Illuminate\Support\Facades\DB;

class Teacher extends TEI implements TeacherInterface
{
    public function getDataItem(): array
    {
        // TODO: Implement getDataItem() method.
        return [];
    }

    public function getDataList(): array
    {
        // TODO: Implement getDataList() method.
        return [];
    }

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
