<?php

namespace App\Http\Controllers;

use App\Http\Models\Group;
use App\Http\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends MainController
{
    public function index()
    {
        parent::access();

        $groups = new Group();
        $groupList = $groups->getGroupList();
        $input['groups'] = $groupList;

        return view('group.index', $input);
    }

    public function create()
    {
        parent::access();

        $teachers = new Teacher();
        $teacherId = $teachers->getTeacherId();
        $input = ['teacher_id' => $teacherId];

        return view('group.create', $input);
    }

    public function add(Request $request)
    {
        parent::access();

        $input = [
            'name' => $request['name'],
            'teacher_id' => $request['teacher_id']
        ];

        Group::create($input);

        return redirect('group');
    }

    public function edit(Request $request)
    {
        parent::access();

        $instance = new Group();
        $group = $instance->getGroupById($request['group_id']);

        return view('group.edit', $group);
    }

    public function store(Request $request)
    {
        parent::access();

        Group::where('id', $request['group_id'])
            ->update([
                'name' => $request['name']
            ]);

        return redirect('group');
    }

    public function delete(Request $request)
    {
        parent::access();

        var_dump($request['group_id']);exit;
    }

    public function select(int $id)
    {
        session(['group_id' => $id]);

        return redirect()
            ->route('home');
    }
}
