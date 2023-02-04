<?php

namespace App\Http\Models;

use App\Http\Interfaces\TeacherInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Teacher extends TEI implements TeacherInterface
{
    protected $table = 'teachers';

    public $timestamps = false;

    protected $fillable = [
        'first_name',
        'last_name',
        'user_id',
        'job_title',
        'educational_institution_id'
    ];

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

    public function check(int $userId = null): bool
    {
        $teacher = $this->getTeacher($userId);

        if (empty($teacher)) return false;

        /*
         'teacher' =>
              'id' => int 1
              'first_name' => string 'Татьяна' (length=14)
              'last_name' => string 'Самойлова' (length=18)
              'user_id' => int 1
              'job_title' => int 1
              'subject_id' => int 1
              'educational_institution_id' => int 1
         */
        $requireFields = [
            'first_name',
            'last_name',
            'job_title',
        ];

        foreach ($requireFields as $field) {
            if (empty($teacher[$field])) return false;
        }

        return true;
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

    public function getTeacherId()
    {
        return $this->getTeacher(Auth::user()->id)['id'];
    }
}
