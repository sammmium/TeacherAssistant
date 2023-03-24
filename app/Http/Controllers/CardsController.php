<?php

namespace App\Http\Controllers;

use App\Http\Models\Cards;
use App\Http\Models\CardValues;
use App\Http\Models\Dicts;
use App\Http\Models\EducationalInstitution;
use App\Http\Models\Members;
use App\Http\Models\People;
use App\Http\Models\Teacher;
use App\Http\Models\Tests;
use App\Http\Models\Unit;
use App\Http\Models\UnitsGroups;
use App\Http\Models\UnitsGroupsPupils;
use App\Http\Models\UnitsSubjects;
use App\Http\Models\WorkStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CardsController extends MainController
{
    public function index(int $ugpId)
    {
        parent::access();

        $ws = WorkStatus::get(Auth::user()->id);
        $teacher = Teacher::getTeacher();
        $unit = Unit::getUnit($teacher['id'], date('Y'));
        $educational_institution = EducationalInstitution::getEducationalInstitution([
            'id' => $unit['educational_institution_id']
        ]);
        $role = Dicts::getById($teacher['role_id']);
        $group = Dicts::getById($ws['group_id']);
        $subject = Dicts::getById($ws['subject_id']);
        $test = Tests::getTest([
            'unit_subject_id' => $ws['unit_subject_id']
        ]);
        $ugp = UnitsGroupsPupils::getPupil($ugpId);
        $pupil = People::getPupil($ugp['pupil_id']);

        $card = Cards::getId([
            'test_id' => $test['id'],
            'unit_group_pupil_id' => $ugpId
        ]);

        $item = CardValues::getValues($card['id']);

        $input = [
            'educational_institution' => $educational_institution,
            'year' => $unit['year'],
            'teacher' => $teacher,
            'role' => $role,
            'group' => $group,
            'subject' => $subject,
            'test' => $test,
            'pupil' => $pupil,
            'unit_group_pupil_id' => $ugpId,
            'pupil_id' => $ugp['pupil_id'],
            'card_id' => $card['id'],
            'item' => $item
        ];

        $sub = $subject['code'];

//        var_dump($input);exit;

        return view('cards.' . $sub . '.index', $input);
    }

    public function store(Request $request)
    {
        $exclude = [
            '_token',
            'sub',
            'subject_id',
            'group_id',
            'test_id',
            'pupil_id',
            'card_id',
        ];

        $cardId = $request['card_id'];

        CardValues::deleteItem($cardId);
        $dict = Dicts::getCodeList('card_codes');

        $input = [];

        foreach ($request->all() as $key => $value) {
            if (!in_array($key, $exclude)) {
                if (!empty($value) && !empty($cardId)) {
                    $input[] = [
                        'card_id' => (int)$cardId,
                        'dict_id' => $this->getPreparedCode($dict, $key),
                        'value' => $value
                    ];
                }
            }
        }

        if (count($input)) {
            CardValues::create($input);
        }

        return redirect()->route('home');
    }

    /**
     * @param array $dict
     * @param string $key
     * @return int|null
     */
    private function getPreparedCode(array $dict, string $key): ?int
    {
        foreach ($dict as $item) {
            if ($item['code'] == $key) {
                return $item['id'];
            }
        }

        return null;
    }

    public function pupil_list(Request $request)
    {
        var_dump('pupil list');exit;
    }
}
