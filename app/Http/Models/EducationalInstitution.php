<?php

namespace App\Http\Models;

class EducationalInstitution extends TEI
{
    public function getSchoolList(): array
    {
        // todo сделать выборку списка школ
        return [];
    }

    public function searchSchool(string $subString): array
    {
        // todo сделать поиск школы по вхождению подстроки
        return [];
    }

    public function hasBaseData(): bool
    {
        // TODO: Implement hasBaseData() method.
        return true;
    }
}
