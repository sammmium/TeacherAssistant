<?php

namespace App\Http\Entities;

use App\Http\Models\BaseModel;

class Teacher extends BaseModel
{
    protected $table = 'teachers';

    /*
     * id
     * first_name
     * last_name
     * user_id
     * role_id
     * subject_id
     */

    private $id;

    private $firstName;

    private $lastName;

    private $subjectId;

    private $userId;

    private $roleId;

    public function getId(): int
    {
        return $this->id;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getFisrtName(): string
    {
        return  $this->firstName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setSubjectId(int $subjectId): void
    {
        $this->subjectId = $subjectId;
    }

    public function getSubjectId(): int
    {
        return $this->subjectId;
    }

    public function setRoleId(int $roleId): void
    {
        $this->roleId = $roleId;
    }

    public function getRoleId(): int
    {
        return $this->roleId;
    }
}
