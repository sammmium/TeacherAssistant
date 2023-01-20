<?php

namespace App\Http\Models;

use App\Http\Interfaces\EducationalInstitutionInterface;

class EducationalInstitution extends TEI implements EducationalInstitutionInterface
{
    public function getEducationalInstitution(int $educationalInstitutionId = null): array
    {
        if (is_null($educationalInstitutionId)) {
            return [];
        }

        $sql = "
            select *
            from educational_institutions
            where id = :eId
            limit 1
        ";
        $params = ['eId' => $educationalInstitutionId];
        $rawData = $this->getRawData($sql, $params);

        return $this->getPreparedData($rawData);
    }

    public function getEducationalInstitutionList(): array
    {
        $sql = "
            select *
            from educational_institutions
            order by asc
            limit 50
        ";
        $rawData = $this->getRawData($sql);

        return $this->getPreparedData($rawData);
    }
}
