<?php

namespace App\Http\Entities;

use App\Http\Interfaces\iBaseData;
use App\Http\Models\BaseModel;

class EducationalInstitution extends BaseModel
{
    public $table = 'educational_institutions';

    /*
     * id
     * name
     * address
     * city
     */

    private $name;

    private $address;

    private $city;

    public function getId(): int
    {
        return $this->id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function getCity(): string
    {
        return $this->city;
    }
}
