<?php

namespace App\Http\Controllers;

use App\Http\Models\Dicts;
use App\Http\Models\Forms\FormManager;
use App\Http\Models\Slots\SlotsFactory;
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
use App\Http\Models\Tests\TestFormStoreHelper;

class TestsController extends MainController
{
    use Helper;

    public function add()
    {

//        $slotFactory = new SlotsFactory();
//        $slotFactory->build([
//            'sub' => 'math',
//            'type' => 'kr',
//            'group' => 1,
//            'name' => 'task1_we_apmb'
//        ]);
////        var_dump($slotFactory->getSlots());
//        var_dump($slotFactory->getSlot());




        $ws = new WSDB();
        $groupId = $ws->get('group_id');
        $subjectId = $ws->get('subject_id');

        $subject = Dicts::getById($subjectId);
        $group = Dicts::getById($groupId);
        $group_num = self::cutGroupNumber($group['code']);

        $testFactory = new TestFactory($subject['code'], $group_num);

        $input = [
            'test_types' => $testFactory->getTypeList()
        ];

        return view('home.test.add', $input);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'type' => 'required|string',
        ]);

        $input = self::transformTestType($request['type']);

        $ws = new WSDB();
        $groupId = $ws->get('group_id');
        $group = Dicts::getById($groupId);
        $input['group'] = self::cutGroupNumber($group['code']);

//        var_dump($input);exit;

        $manager = new FormManager($input);
        $formItems = $manager->getFormItems();

        $view = $formItems['view'];
        unset($formItems['view']);

        $formItems['sub'] = $input['sub'];
        $formItems['group'] = $input['group'];
        $formItems['type'] = $input['type'];

//        var_dump($formItems);exit;

        return view('home.test.' . $view, $formItems);
    }

    public function form_store(Request $request)
    {
        $input = $request->all();

//        var_dump($input);exit;
        $helper = new TestFormStoreHelper($input);
        $cleared = $helper->handler();

        var_dump($cleared);exit;













        var_dump($request->all());exit;
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
