<?php

namespace App\Http\Models;

use Illuminate\Support\Facades\Auth;

class Group extends BaseModel
{
    protected $table = 'groups';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'teacher_id'
    ];

    public function getGroupList(): array
    {
        $userId = Auth::user()->id;
        $sql = "
            select *
            from groups
            where teacher_id = (
                select id
                from teachers
                where user_id = :userId
            )";
        $params = ['userId' => $userId];
        $rawData = $this->getRawData($sql, $params);
        return $this->getPreparedData($rawData);
    }

    public function getGroupById(int $groupId): array
    {
        $sql = "
            select *
            from groups
            where id = :id
        ";
        $params = ['id' => $groupId];
        $rawData = $this->getRawData($sql, $params);
        return $this->getPreparedData($rawData);
    }
}
