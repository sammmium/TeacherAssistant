<?php

namespace App\Http\Interfaces;

interface TeacherInterface
{
    /**
     * Данные об учителе
     *
     * @param int $userId
     * @return array
     */
    public function getTeacher(int $userId): array;

    /**
     * Список групп за одним учителем
     *
     * @param int $userId
     * @return array
     */
    public function getGroupList(int $userId): array;

    /**
     * Список участников группы (учеников класса)
     *
     * @param int $groupId
     * @return array
     */
    public function getGroupMembersList(int $groupId): array;
}
