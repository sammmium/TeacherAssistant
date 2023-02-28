<?php

namespace App\Http\Models;

use App\Http\Interfaces\TeacherInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Teacher extends TEI implements TeacherInterface
{
    protected $table = 'people';

    public $timestamps = false;

    protected $fillable = [
        'lastname',
        'firstname',
        'patronymic',
        'birthdate',
        'description',
        'role_id',
        'user_id',
    ];

    public static function init()
    {
        $userId = parent::init();

        $teacher = DB::table('people')
            ->select('*')
            ->where(['user_id' => $userId])
            ->get();

        Unit::initUnit($teacher['id']);

        return $teacher;
    }

    public static function getTeacher(): array
    {
        $userId = parent::init();

        return self::prepare(DB::table('people')
            ->select('*')
            ->where(['user_id' => $userId])
            ->get());
    }

    public static function check(): bool
    {
        $teacher = self::getTeacher();

        if (empty($teacher)) return false;

        $requireFields = [
            'firstname',
            'lastname',
            'role_id',
        ];

        foreach ($requireFields as $field) {
            if (empty($teacher[$field])) return false;
        }

        Unit::initUnit($teacher['id']);

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
