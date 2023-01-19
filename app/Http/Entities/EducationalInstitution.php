<?php

namespace App\Http\Entities;

use App\Http\Interfaces\iBaseData;
use App\Http\Models\BaseModel;

class EducationalInstitution
{
    private $table = 'educational_institutions';

    /*
     * id
     * name
     * address
     * city
     */

    private $id;

    private $fullName;

    private $shortName;

    private $address;

    private $cityId;

    public function getId(): int
    {
        return $this->id;
    }

    public function getEducationalInstitutionId(): int
    {
        return $this->getId();
    }

    public function setFullName(string $name): void
    {
        $this->fullName = $name;
    }

    public function getFullName(): string
    {
        return $this->fullName;
    }

    public function setShortName(string $name): void
    {
        $this->shortName = $name;
    }

    public function getShortName(): string
    {
        return $this->shortName;
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setCityId(int $cityId): void
    {
        $this->cityId = $cityId;
    }

    public function getCityId(): string
    {
        return $this->cityId;
    }
}
