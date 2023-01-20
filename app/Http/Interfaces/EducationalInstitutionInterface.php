<?php

namespace App\Http\Interfaces;

interface EducationalInstitutionInterface
{
    public function getEducationalInstitution(int $educationalInstitutionId = null): array;

    public function getEducationalInstitutionList(): array;
}
