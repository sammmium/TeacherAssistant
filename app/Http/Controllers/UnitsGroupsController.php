<?php

namespace App\Http\Controllers;

use App\Http\Models\Dicts;
use App\Http\Models\EducationalInstitution;
use App\Http\Models\Group;
use App\Http\Models\Teacher;
use App\Http\Models\Unit;
use App\Http\Models\UnitsGroups;
use App\Http\Models\WorkStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UnitsGroupsController extends MainController
{
    public function index()
    {
        $year = date('Y');
        $teacher = Teacher::getTeacher();
        $unit = Unit::getUnit($teacher['id'], $year);
        WorkStatus::set('unit', $unit['id']);
        $params = [
            'id' => $unit['educational_institution_id']
        ];
        $educationalInstitution = EducationalInstitution::getEducationalInstitution($params);
        $role = Dicts::getById($teacher['role_id']);
        $groupList = UnitsGroups::getGroupList($unit['id']);
//        var_dump($role);exit;
        $input = [
            'teacher' => $teacher,
            'educational_institution' => $educationalInstitution,
            'role' => $role['value'],
            'year' => $year,
            'group_list' => $groupList,
            'unit_id' => $unit['id']
        ];

//        var_dump($input);exit;

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
        WorkStatus::set('group', $groupId);
        $ws = WorkStatus::get(Auth::user()->id);
        $ug = UnitsGroups::getUnitGroup([
            'unit_id' => $ws['unit_id'],
            'group_id' => $groupId
        ]);
        WorkStatus::set('unit_group_id', $ug['id']);
        $route = WorkStatus::selectRoute();

        return redirect($route);
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
        $group = Dicts::getById($groupId);

        $input = [
            'group' => $group
        ];

//        var_dump($group);exit;
        return view('pupils.list', $input);
    }
}
