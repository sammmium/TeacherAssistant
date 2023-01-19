<?php

namespace App\Http\Models;

use App\Http\Interfaces\EducationalInstitutionInterface;

class EducationalInstitution extends TEI implements EducationalInstitutionInterface
{
    public function getDataItem(): array
    {
        // TODO: Implement getSchoolItem() method.
        return [];
    }

    public function getDataList(): array
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
