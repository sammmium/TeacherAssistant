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
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

use function Ramsey\Uuid\v1;

class TestsController extends MainController
{
    use Helper;

    public function add()
    {
        $ws = new WSDB();
        $groupId = $ws->get('group_id');
        $subjectId = $ws->get('subject_id');

        $subject = Dicts::getById($subjectId);
        $group = Dicts::getById($groupId);
        $group_num = self::cutGroupNumber($group['code']);

        $testFactory = new TestFactory($subject['code'], $group_num);

        $input = [
            'test_types' => $testFactory->getTypeList(),
        ];

        return view('home.test.add', $input);
    }

    public function add_theme(Request $request)
    {
        $this->validate($request, [
            'type' => 'required|string',
        ]);
        $ws = new WSDB();
        $unitSubjectId = $ws->get('unit_subject_id');
        $unitGroupId = $ws->get('unit_group_id');
        $testType = $request['type'];
        Redis::set('type', $testType);

        $options = Tests::getThemeOptions([
            'unit_subject_id' => $unitSubjectId,
            'unit_group_id' => $unitGroupId,
            'type' => $testType
        ]);

        $input = [
            'test_themes' => $options
        ];

        return view('home.test.add_theme', $input);
    }

    public function show_selected_form(Request $request)
    {

        $this->validate($request, [
            'theme_id' => 'required|numeric',
            'new_theme' => 'sometimes',
            'date' => 'sometimes',
        ]);
        // var_dump('WTF');exit;

        $testId = null;
        $ws = new WSDB();
        $unitSubjectId = $ws->get('unit_subject_id');
        $unitGroupId = $ws->get('unit_group_id');
        $type = Redis::get('type');
        $input = $request->all();
        $date = !empty($input['date']) ? self::transformDate($input['date'], 'en') : date('Y-m-d');

        // var_dump(compact('themeId', 'unitSubjectId', 'unitGroupId', 'type', 'date'));exit;

        try {
            if ($input['theme_id'] == 0) {
                // var_dump('var 1');exit;
                if (!empty($input['new_theme'])) {
                    $options = [
                        'name' => $input['new_theme'],
                        'date' => $date,
                        'unit_subject_id' => $unitSubjectId,
                        'unit_group_id' => $unitGroupId,
                        'type' => $type,
                    ];
                    Tests::create($options);
                    $testId = Tests::getLastInsertId($options);
                } else {
                    throw new Exception('Не выбрано ни одного значения и не заполнено ни одного поля!');
                }
            } else {
                $testId = $input['theme_id'];
            }
        } catch(Exception $ex) {
            Log::error('[' . __METHOD__ . '] ' . $ex->getMessage());
        }

        // достаем слоты по параметрам
        // передаем их в форму

        $transformedTestType = self::transformTestType($type);
        $group = Dicts::getById($ws->get('group_id'));
        $group_num = self::cutGroupNumber($group['code']);

        $slotData = [
            'sub' => $transformedTestType['sub'],
            'type' => $transformedTestType['type'],
            'group' => $group_num,
            // 'name' => 'task1_we_apmb'
        ];

        // var_dump(compact('slotData'));exit;
        $slotFactory = new SlotsFactory($slotData);
        var_dump($slotFactory->getSlots());
        // var_dump($slotFactory->getSlot());


        var_dump(compact('testId', 'unitSubjectId', 'unitGroupId', 'type', 'date'));exit;
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
