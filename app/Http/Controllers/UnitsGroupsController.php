<?php

namespace App\Http\Controllers;

use App\Http\Models\Cards;
use App\Http\Models\CardValues;
use App\Http\Models\Dicts;
use App\Http\Models\EducationalInstitution;
use App\Http\Models\Group;
use App\Http\Models\People;
use App\Http\Models\Teacher;
use App\Http\Models\Unit;
use App\Http\Models\UnitsGroups;
use App\Http\Models\UnitsGroupsPupils;
use App\Http\Models\WorkStatus;
use App\Http\Models\WS;
use App\Http\Models\WSDB;
use App\Http\Traits\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UnitsGroupsController extends MainController
{
    public function index()
    {
        $year = date('Y');
        $teacher = Teacher::getTeacher();
        $unit = Unit::getUnit($teacher['id'], $year);
        $ws = new WSDB();
        $ws->set('unit_id', $unit['id']);
        $ws->set('teacher_id', $teacher['id']);
        $ws->set('educational_institution_id', $unit['educational_institution_id']);
        $ws->save();
        $params = [
            'id' => $unit['educational_institution_id']
        ];
        $educationalInstitution = EducationalInstitution::getEducationalInstitution($params);
        $role = Dicts::getById($teacher['role_id']);
        $groupList = UnitsGroups::getGroupList($unit['id']);
        $input = [
            'teacher' => $teacher,
            'educational_institution' => $educationalInstitution,
            'role' => $role['value'],
            'year' => $year,
            'group_list' => $groupList,
            'unit_id' => $unit['id']
        ];

        return view('home.group.list', $input);
    }

    /**
     * @param int $groupId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function group_reset(int $groupId)
    {
        $year = date('Y');
        $teacher = Teacher::getTeacher();
        $unit = Unit::getUnit($teacher['id'], $year);

        UnitsGroups::where([
            'group_id' => $groupId,
            'unit_id' => $unit['id'],
        ])->delete();

        return redirect()->route('home-groups-index');
        // todo проверить замену маршрута на home
    }

    /**
     * Отображение формы выбора группы
     *
     * @param int $groupId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function select(int $groupId)
    {
        $ws = new WSDB();
        $ws->set('group_id', $groupId);
        $ug = UnitsGroups::getUnitGroup([
            'unit_id' => $ws->get('unit_id'),
            'group_id' => $groupId
        ]);
        $ws->set('unit_group_id', $ug['id']);
        $ws->save();

        return redirect($ws->selectRoute());
    }

    /**
     * Проверка наличия и создание записи
     * (добавление записи в список выбранных)
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function selected(Request $request)
    {
        $this->validate($request, [
            'unit_id' => 'required|numeric',
            'group_id' => 'required|numeric',
        ]);

        $input = [
            'unit_id' => (int)$request['unit_id'],
            'group_id' => (int)$request['group_id'],
        ];

        if (!UnitsGroups::has($input)) {
            UnitsGroups::create($input);
        }

        return redirect()->route('home');
    }

    public function group_add()
    {
        $groupList = Dicts::getOptions('groups');
        $year = date('Y');
        $teacher = Teacher::getTeacher();
        $unit = Unit::getUnit($teacher['id'], $year);
        $ws = WorkStatus::get($teacher['user_id']);

        return view('home.group.add', [
            'group_list' => $groupList,
            'unit_id' => $unit['id'],
            'unit_group_id' => $ws['unit_group_id'],
        ]);
    }

    public function group_fill(int $groupId)
    {
        parent::access();

        $group = Dicts::getById($groupId);
        $ws = WorkStatus::get(Auth::user()->id);
        $pupils = UnitsGroupsPupils::getFullPupilList([
            'unit_group_id' => $ws['unit_group_id']
        ]);

        $input = [
            'group' => $group,
            'pupils' => $pupils,
            'unit_group_id' => $ws['unit_group_id'],
        ];

        return view('pupils.list', $input);
    }

    public function group_pupil_create(int $groupId)
    {
        parent::access();

        $group = Dicts::getById($groupId);

        return view('pupils.create', ['group' => $group]);
    }

    /**
     * Сохраняем данные нового ученика.
     * Обязательные параметры: firstname, lastname, birthdate.
     * Обеспечиваем одновременное добавление ученика в список класса.
     * Перенаправляем пользователя на форму редактирования списка класса.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function group_pupil_store(Request $request)
    {
        parent::access();

        $userId = Auth::user()->id;

        $this->validate($request, [
            'group_id' => 'required|numeric',
            'lastname' => 'required',
            'firstname' => 'required',
            'patronymic' => 'sometimes',
            'birthdate' => 'required|date',
            'description' => 'sometimes',
        ]);
        $role = Dicts::getByCode('pupil');
        $input = [
            'firstname' => $request['firstname'],
            'lastname' => $request['lastname'],
            'patronymic' => $request['patronymic'],
            'description' => $request['description'],
            'role_id' => (int)$role['id'],
            'user_id' => (int)$userId,
        ];
        if (!empty($request['birthdate'])) {
            $input['birthdate'] = $this->transformDate($request['birthdate'], 'en');
        }
        $pupil = People::create($input);

        $ws = WorkStatus::get($userId);
        UnitsGroupsPupils::create([
            'unit_group_id' => $ws['unit_group_id'],
            'pupil_id' => $pupil->id
        ]);

        return redirect()
            ->route('group-pupil-add', (int)$request['group_id']);
    }

    /**
     * Форма редактирования ученика
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function group_pupil_edit(int $id)
    {
        parent::access();

        $gr = UnitsGroupsPupils::getGroupId($id);
        $group = Dicts::getById($gr['id']);
        $pupil = People::getPupil($id);
        $pupil['birthdate'] = $this->transformDate($pupil['birthdate'], 'ru');

        return view('pupils.edit', [
            'group' => $group,
            'pupil' => $pupil
        ]);
    }

    /**
     * при удалении ученика из группы (класса) нужно удалить из таблиц:
     * - card_values
     * - cards
     * - units_groups_pupils
     * - people
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function group_pupil_delete(Request $request)
    {
        parent::access();

        $userId = Auth::user()->id;
        $pupilId = $request['id'];
        $unitGroupId = $request['unit_group_id'];
        $ugp = UnitsGroupsPupils::getId([
            'pupil_id' => $pupilId,
            'unit_group_id' => $unitGroupId,
        ]);
        $ugpId = (!empty($ugp)) ? $ugp['id'] : null;

        if (!empty($ugpId)) {
            $ws = WorkStatus::get($userId);
            $card = Cards::getId([
                'unit_group_pupil_id' => $ugpId,
                'test_id' => $ws['test_id']
            ]);
            $cardId = (!empty($card)) ? $card['id'] : null;

            if (!empty($cardId)) {
                // удалить карточку и связанные с ней записи
                CardValues::where('card_id', '=', $cardId)->delete();
                Cards::where('id', '=', $cardId)->delete();
            }

            // удалить запись об ученике из UGP
            UnitsGroupsPupils::where('id', '=', $ugpId)->delete();
        }

        // удалить запись об ученике из people
        People::where('id', '=', $pupilId)->delete();

        return redirect('/home/group/' . $ws['group_id'] . '/fill');
    }
}
