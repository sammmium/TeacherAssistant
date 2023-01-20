<?php

namespace App\Http\Models;

use App\Http\Entities\Core;
use App\Http\Interfaces\CoreInterface;
use App\Http\Interfaces\EducationalInstitutionInterface as EducationalInstitution;
use App\Http\Interfaces\TeacherInterface as Teacher;
//use Illuminate\Support\Facades\Auth;

class CoreData implements CoreInterface
{
    protected $core;

    protected $user;

    protected $educationalInstitution;

    protected $teacher;

    public function __construct($user, Teacher $teacher, EducationalInstitution $educationalInstitution)
    {
        $this->prepareUserData($user);
        $this->educationalInstitution = $educationalInstitution;
        $this->teacher = $teacher;
        $this->core = new Core();
    }

    private function prepareUserData($user): void
    {
        $this->user['id'] = $user->id;
        $this->user['name'] = $user->name;
        $this->user['email'] = $user->email;
    }

    public function getCoreData(): array
    {
        $this->prepareCoreData();
        return $this->core->getCore();
    }

    private function prepareCoreData(): void
    {
        $this->core->set('teacher',
            $this->teacher->getTeacher($this->user['id'])
        );

        $this->core->set('educationalInstitution',
            $this->educationalInstitution->getEducationalInstitution(
                $this->core->get('teacher', 'educational_institution_id')
            )
        );
    }
}
