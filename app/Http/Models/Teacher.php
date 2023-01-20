<?php

namespace App\Http\Models;

use App\Http\Interfaces\TeacherInterface;
use Illuminate\Support\Facades\DB;

class Teacher extends TEI implements TeacherInterface
{
    public function getTeacher(int $userId): array
    {
        $sql = "
            select *
            from teachers
            where user_id = :userId
            limit 1";
        $params = ['userId' => $userId];
        $rawData = $this->getRawData($sql, $params);
        return $this->getPreparedData($rawData);
    }

    public function getEducationalInstitution(int $userId): array
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

    public function getGroupList(int $userId): array
    {
        // TODO: Implement getGroupList() method.
        return [];
    }


    public function getGroupMembersList(int $groupId): array
    {
        // TODO: Implement getGroupMembersList() method.
        return [];
    }
}
