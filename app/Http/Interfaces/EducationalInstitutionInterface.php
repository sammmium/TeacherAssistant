<?php

namespace App\Http\Interfaces;

interface EducationalInstitutionInterface
{
    public function getEducationalInstitutionById(int $educationalInstitutionId = null): array;

    public function getEducationalInstitutionByUserId(int $userId): array;

    public function getEducationalInstitutionList(): array;
}
