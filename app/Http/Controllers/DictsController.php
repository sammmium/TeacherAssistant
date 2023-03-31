<?php

namespace App\Http\Controllers;

use App\Http\Models\Dicts;
use Illuminate\Http\Request;

class DictsController extends MainController
{
    public function index()
    {
        $input['items'] = Dicts::getDicts();

        return view('dicts.index', $input);
    }

    public function select(int $id)
    {
        $selected = Dicts::getById($id);
        $input['selected'] = $selected;
        $input['items'] = Dicts::getOptions($selected['code']);

        return view('dicts.subitems', $input);
    }

    public function add(Request $request)
    {
        $selectedId = $request['selected_dict'];
        $selected = Dicts::getById($selectedId);
        $input['selected'] = $selected;

        return view('dicts.add', $input);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'parent_id' => 'required|numeric',
            'code' => 'required|max:255',
            'value' => 'required|max:255',
            'description' => 'sometimes|max:255',
        ]);

        $input = [
            'parent_id' => $request['parent_id'],
            'code' => $request['code'],
            'value' => $request['value'],
            'description' => $request['description'],
        ];
        Dicts::create($input);

        return redirect('/dict/' . $request['parent_id']);
    }

    public function edit(int $id)
    {
        $input['item'] = Dicts::getById($id);
        $input['selected'] = Dicts::getById($input['item']['parent_id']);

        return view('dicts.edit', $input);
    }

    public function update(Request $request)
    {
        $update = [
            'code' => $request['code'],
            'value' => $request['value'],
            'description' => $request['description'],
        ];
        $where = [
            'id' => $request['id']
        ];

        Dicts::where($where)->update($update);

        return redirect('/dict/' . $request['parent_id']);
    }

    public function delete(Request $request)
    {
        $where['id'] = $request['id'];
        Dicts::where($where)->delete();

        return redirect('/dict/' . $request['parent_id']);
    }

    public function group_create()
    {
        $selected = Dicts::getByCode('groups');
        $input['selected'] = $selected;

        return view('dicts.add', $input);
    }

    public function subject_create()
    {
        $selected = Dicts::getByCode('subjects');
        $input['selected'] = $selected;

        return view('dicts.add', $input);
    }
}
