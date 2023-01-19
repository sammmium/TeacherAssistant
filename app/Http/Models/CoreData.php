<?php

namespace App\Http\Models;

use App\Http\Interfaces\CoreInterface;
use App\Http\Interfaces\EducationalInstitutionInterface as EducationalInstitution;
use App\Http\Interfaces\TeacherInterface as Teacher;
//use Illuminate\Support\Facades\Auth;

class CoreData implements CoreInterface
{
    protected $user;

    protected $educationalInstitution;

    protected $teacher;

    public function __construct($user, Teacher $teacher, EducationalInstitution $educationalInstitution)
    {
        $this->user = $user;
        $this->educationalInstitution = $educationalInstitution;
        $this->teacher = $teacher;
    }

    public function getDataItem(): array
    {
        return ['data from core'];
        // TODO: Implement getDataItem() method.
        return [];
    }

    public function getDataList(): array
    {
        // TODO: Implement getDataList() method.
        return [];
    }

    /*
     array (size=7)
      +'id' => int 2
      'first_name' => string 'Евгений' (length=14)
      'last_name' => string 'Самойлов' (length=16)
      'user_id' => int 2
      'role_id' => int 1
      'subject_id' => int 1
      +'educational_institution_id' => int 1

    array (size=5)
      'id' => int 1
      'full_name' => string 'Гимназия 2' (length=18)
      'short_name' => string 'Г2' (length=3)
      'address' => string 'Минск' (length=10)
      'city_id' => int 1
     */
}
