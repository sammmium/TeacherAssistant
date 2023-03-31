<?php

namespace App\Http\Controllers;

use App\Http\Models\Dicts;
use App\Http\Models\Teacher;
use App\Http\Models\Tests\TestFactory;
use App\Http\Models\Tests;
use App\Http\Models\Unit;
use App\Http\Models\UnitsGroups;
use App\Http\Models\UnitsSubjects;
use App\Http\Models\WorkStatus;
use App\Http\Models\WSDB;
use App\Http\Traits\Helper;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;
use App\Http\Models\MathAnalyzer;

class TestsController extends MainController
{
    use Helper;

    public function add()
    {
        $year = date('Y');
        $teacher = Teacher::getTeacher();
        $unit = Unit::getUnit($teacher['id'], $year);
        $ws = new WSDB();
        $groupId = $ws->get('group_id');
        $subjectId = $ws->get('subject_id');
        $unitGroup = UnitsGroups::getUnitGroup([
            'unit_id' => $unit['id'],
            'group_id' => $groupId
        ]);
        $unitSubject = UnitsSubjects::getUnitSubject([
            'unit_group_id' => $unitGroup['id'],
            'subject_id' => $subjectId
        ]);
        $subject = Dicts::getById($subjectId);
        $group = Dicts::getById($groupId);
        $group_num = self::cutGroupNumber($group['code']);

        $testFactory = new TestFactory($subject['code'], $group_num);

        $input = [
            'unit_subject_id' => $unitSubject['id'],
            'unit_group_id' => $unitGroup['id'],
            'test_types' => $testFactory->getTypeList()
        ];

        return view('home.test.add', $input);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'type' => 'required|string',
            'date' => 'required|date',
            'unit_subject_id' => 'required|numeric',
            'unit_group_id' => 'required|numeric',
        ]);

        $input = [
            'name' => $request['name'],
            'date' => self::transformDate($request['date'], 'en'),
            'unit_subject_id' => (int)$request['unit_subject_id'],
            'unit_group_id' => (int)$request['unit_group_id'],
            'type' => $request['type'],
        ];

        if (!Tests::has($input)) {
            Tests::create($input);
        }

        return redirect()->route('home');
    }

    public function select(int $id)
    {
        $ws = new WSDB();
        $ws->set('test_id', $id);
        $ws->save();

        return redirect($ws->selectRoute());
    }

    public function download(Request $request)
    {
        $subject = Dicts::getById($request['subject_id']);
        $nameAnalyzer = '\App\Http\Models\\' . ucfirst($subject['code']) . 'Analyzer';
//        var_dump($nameAnalyzer);exit();
        $analyzer = new $nameAnalyzer($request->all());
        $input = $analyzer->getAnalyzedData();





        $templateFileName = $input['template_file_name'];
        $templatePath = public_path('templates');
        $templateFile = $templatePath . '/' . $templateFileName;
        $document = new TemplateProcessor($templateFile);

        $third_table = $input['third_table'];
//        var_dump($third_table);exit;
        unset($input['third_table']);
        unset($input['member_id_list']);
//        var_dump($input);exit;
        $document->setValues($input);

        $document->cloneRowAndSetValues('xtr_tq', $third_table);

        header("Content-Description: File Transfer");
        header('Content-Disposition: attachment; filename="' . $templateFileName . '"');
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Expires: 0');

        $document->saveAs("php://output");
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function selected(Request $request)
    {
        $this->validate($request, [
            'unit_group_id' => 'required|numeric',
            'unit_subject_id' => 'required|numeric',
            'date' => 'required|date',
            'name' => 'required|string',
        ]);

        $input = [
            'unit_group_id' => (int)$request['unit_group_id'],
            'unit_subject_id' => (int)$request['unit_subject_id']
        ];

        if (!Tests::has($input)) {
            $input['date'] = self::transformDate($request['date'], 'en');
            $input['name'] = $request['name'];
            Tests::create($input);
        }

        return redirect()->route('home');
    }
}
