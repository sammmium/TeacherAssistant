<?php

namespace App\Http\Controllers;

use App\Http\Models\Core;
use App\Http\Models\CoreData;
use App\Http\Models\EducationalInstitution;
use App\Http\Models\Group;
use App\Http\Models\Teacher;
use App\Http\Models\WorkStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpWord\TemplateProcessor;

class HomeController extends MainController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // временно редиректим для теста
//        $route = 'home-group-list';
        WorkStatus::init();
        $route = WorkStatus::selectRoute();

//        var_dump($route);

        return redirect($route);
//            ->route($route);

        parent::access();

        if (!Core::check()) {
            return redirect()
                ->route('settings');
        }

        $input = [];

        /*
         * готовим список групп
         * если группа выбрана, то сохраняем ее в сессию
         * добавление в сессию возможно только после ее наполнения хотя бы одним учеником
         * если в ней еще нет учеников, то перенаправляем пользователя в форму заполнения группы учениками
         */

        $groups = new Group();
        $input['groups'] = $groups->getGroupList();

        /*
         * если в сессии сохранена группа, то готовим список контрольных
         */

        $tests = [
            ['id' => 1, 'date' => '2023-01-15', 'subject' => 'математика'],
            ['id' => 2, 'date' => '2023-01-20', 'subject' => 'белорусский язык'],
            ['id' => 13, 'date' => '2023-01-23', 'subject' => 'русский язык'],
            ['id' => 64, 'date' => '2023-01-23', 'subject' => 'белорусская литература'],
        ];
        $input['tests'] = $tests;

        return view('home', $input);
    }

    public function group_list()
    {
        parent::access();
        $input = $this->test_data();
        return view('home.group.list', $input);
    }

    public function group_list_return()
    {
        WorkStatus::clear('group');
        WorkStatus::clear('subject');
        WorkStatus::clear('test');
        WorkStatus::clear('card');
        $route = WorkStatus::selectRoute();

        return redirect($route);
    }

    public function group_index(int $id)
    {
        parent::access();
        WorkStatus::set('group', $id);
        // todo выбрать необходимые данные по $id
        $input = $this->test_data();
        return view('home.subject.list', $input);
    }

    public function subject_index(int $id)
    {
        parent::access();
        // todo выбрать необходимые данные по $id
        WorkStatus::set('subject', $id);
        $input = $this->test_data();
        return view('home.test.list', $input);
    }

    public function subject_list()
    {
        parent::access();
        WorkStatus::clear('subject');
        WorkStatus::clear('test');
        WorkStatus::clear('card');
        $route = WorkStatus::selectRoute();

        return redirect($route);
    }

    public function test_index(int $id)
    {
        parent::access();
        // todo выбрать необходимые данные по $id
        WorkStatus::set('test', $id);
        $input = $this->test_data();

        return view('home.pupil.list', $input);
    }

    public function test_list()
    {
        parent::access();
        WorkStatus::clear('test');
        WorkStatus::clear('card');
        $route = WorkStatus::selectRoute();

        return redirect($route);
    }

    public function card_index(int $id)
    {
        parent::access();
        // todo выбрать необходимые данные по $id
        WorkStatus::set('card', $id);
        $input = $this->test_data();

        return view('home.card.index', $input);
    }

    public function card_list()
    {
        parent::access();
        WorkStatus::clear('card');
        $route = WorkStatus::selectRoute();

        return redirect($route);
    }

    public function card_store(Request $request)
    {
        var_dump($request->all());exit;

        $request['subject_id'];
        $request['group_id'];
        $request['test_id'];
        $request['pupil_id'];
        $request['range'];

        $request['eq_woe'];
        $request['eq_eis'];
        $request['eq_eic'];
        $request['eq_wr'];

        $request['ex_woe'];
        $request['ex_eio'];
        $request['ex_eca'];
        $request['ex_ecs'];
        $request['ex_ecm'];
        $request['ex_ecd'];
        $request['ex_wr'];

        $request['co_woe'];
        $request['co_n'];
        $request['co_ne'];
        $request['co_dcn'];
        $request['co_en'];
        $request['co_lv'];
        $request['co_mv'];
        $request['co_tv'];
        $request['co_wr'];

        $request['t_woe'];
        $request['t_dd'];
        $request['t_dc'];
        $request['t_wr'];

        $request['gt_woe'];
        $request['gt_dd'];
        $request['gt_dc'];
        $request['gt_ded'];
        $request['gt_wr'];

        $request['cv_woe'];
        $request['cv_l'];
        $request['cv_m'];
        $request['cv_t'];
        $request['cv_wr'];

        $request['fx'];
    }

    private function test_data(): array
    {
        $input = [
            'educational_institution' => [
                'id' => 1,
                'full_name' => 'Учреждение образования "Гимназия №2"',
                'short_name' => 'Гимназия №2',
                'address' => 'г. Минск'
            ],
            'teacher' => [
                'id' => 2,
                'first_name' => 'Татьяна',
                'last_name' => 'Самойлова',
                'job_title' => 'Учитель начальных классов',
            ],
            'group_list' => [
                ['id' => 3, 'name' => '2 "В"'],
                ['id' => 18, 'name' => '4 "Д"'],
                ['id' => 24, 'name' => '3 "А"'],
            ],
            'group' => [
                'id' => 18,
                'name' => '4 "Д"'
            ],
            'subject_list' => [
                ['id' => 3, 'name' => 'Русский язык'],
                ['id' => 4, 'name' => 'Русская литература'],
                ['id' => 18, 'name' => 'Метематика'],
                ['id' => 20, 'name' => 'Белорусский язык'],
                ['id' => 21, 'name' => 'Белорусская литература'],
            ],
            'subject' => [
                'id' => 18,
                'name' => 'Метематика'
            ],
            'pupil_list' => [
                ['id' => 144, 'first_name' => 'Глафира', 'last_name' => 'Подоляко', 'year' => '2013'],
                ['id' => 145, 'first_name' => 'Феофан', 'last_name' => 'Артамонов', 'year' => '2013'],
                ['id' => 146, 'first_name' => 'Иван', 'last_name' => 'Сидоров', 'year' => '2013'],
                ['id' => 147, 'first_name' => 'Георгий', 'last_name' => 'Корешков', 'year' => '2013'],
                ['id' => 148, 'first_name' => 'Валентина', 'last_name' => 'Смолячкова', 'year' => '2013'],
            ],
            'pupil' => [
                'id' => 146,
                'first_name' => 'Иван',
                'last_name' => 'Сидоров',
                'year' => '2013'
            ],
            'test_list' => [
                ['id' => 16, 'name' => '20230112-метематика'],
                ['id' => 52, 'name' => '20230118-русский-язык'],
                ['id' => 87, 'name' => '20230123-физкультура'],
            ],
            'test' => [
                'id' => '168',
                'template' => 4,
                'name' => 'Тестовая тема',
                'date' => [
                    'year' => 2023,
                    'month' => 1,
                    'day' => 18
                ],
                'count_pupils' => 5,
                'count_members' => 5,
                'ratings' => [
                    ['rating' => 10, 'count' => 1, 'percentage' => 20],
                    ['rating' => 9, 'count' => 0, 'percentage' => 0],
                    ['rating' => 8, 'count' => 2, 'percentage' => 40],
                    ['rating' => 7, 'count' => 1, 'percentage' => 20],
                    ['rating' => 6, 'count' => 1, 'percentage' => 20],
                    ['rating' => 5, 'count' => 0, 'percentage' => 0],
                    ['rating' => 4, 'count' => 0, 'percentage' => 0],
                    ['rating' => 3, 'count' => 0, 'percentage' => 0],
                    ['rating' => 2, 'count' => 0, 'percentage' => 0],
                    ['rating' => 1, 'count' => 0, 'percentage' => 0],
                ],
                'average_rating' => ((10+8+8+7+6)/5),
                'levels' => [
                    'high' => ['count' => 1, 'percentage' => 20],
                    'enough' => ['count' => 3, 'percentage' => 60],
                    'middle' => ['count' => 1, 'percentage' => 20],
                    'satisfying' => ['count' => 0, 'percentage' => 0],
                    'low' => ['count' => 0, 'percentage' => 0]
                ],
                'tasks' => [
                    [
                        'type' => 'Сложение двузначных чисел',
                        'without_errors' => ['count' => 5, 'percentage' => 100],
                        'with_errors' => ['count' => 0, 'percentage' => 0],
                        'without_realize' => ['count' => 0, 'percentage' => 0]
                    ],
                    [
                        'type' => 'Вычитание двузначных чисел',
                        'without_errors' => ['count' => 1, 'percentage' => 20],
                        'with_errors' => ['count' => 4, 'percentage' => 80],
                        'without_realize' => ['count' => 0, 'percentage' => 0]
                    ],
                    [
                        'type' => 'Деление двузначных чисел',
                        'without_errors' => ['count' => 1, 'percentage' => 20],
                        'with_errors' => ['count' => 3, 'percentage' => 60],
                        'without_realize' => ['count' => 1, 'percentage' => 20]
                    ],
                    [
                        'type' => 'Умножение двузначных чисел',
                        'without_errors' => ['count' => 1, 'percentage' => 20],
                        'with_errors' => ['count' => 4, 'percentage' => 80],
                        'without_realize' => ['count' => 0, 'percentage' => 0]
                    ],
                    [
                        'type' => 'Сравнение двузначных чисел',
                        'without_errors' => ['count' => 1, 'percentage' => 20],
                        'with_errors' => ['count' => 3, 'percentage' => 60],
                        'without_realize' => ['count' => 1, 'percentage' => 20]
                    ],
                ],
                'error_analyze' => [
                    // Решение уравнений
                    'equation' => [
                        // выполнили  задание правильно
                        // eq_woe_cm
                        // eq_woe_pm
                        'without_errors' => [
                            'count_members' => 1,
                            'percentage_members' => 20
                        ],
                        // ошибки в ходе решения
                        // eq_eis_cm
                        // eq_eis_pm
                        'errors_in_solution' => [
                            'count_members' => 1,
                            'percentage_members' => 20
                        ],
                        // ошибки в вычислениях
                        // eq_eic_cm
                        // eq_eic_pm
                        'errors_in_calculation' => [
                            'count_members' => 1,
                            'percentage_members' => 20
                        ],
                        // не приступили к решению
                        // eq_wr_cm
                        // eq_wr_pm
                        'without_realize' => [
                            'count_members' => 1,
                            'percentage_members' => 20
                        ]
                    ],
                    // Решение выражений
                    'expression' => [
                        // выполнили  задание правильно
                        // ex_woe_cm
                        // ex_woe_pm
                        'without_errors' => [
                            'count_members' => 1,
                            'percentage_members' => 20
                        ],
                        // ошибки в порядке действий
                        // ex_eio_cm
                        // ex_eio_pm
                        'errors_in_orders' => [
                            'count_members' => 1,
                            'percentage_members' => 20
                        ],
                        // ошибки в вычислениях (сложение)
                        // ex_eca_cm
                        // ex_eca_pm
                        'errors_in_calculation_addition' => [
                            'count_members' => 1,
                            'percentage_members' => 20
                        ],
                        // ошибки в вычислениях (вычитание)
                        // ex_ecs_cm
                        // ex_ecs_pm
                        'errors_in_calculation_subtraction' => [
                            'count_members' => 1,
                            'percentage_members' => 20
                        ],
                        // ошибки в вычислениях (умножение)
                        // ex_ecm_cm
                        // ex_ecm_pm
                        'errors_in_calculation_multiplication' => [
                            'count_members' => 1,
                            'percentage_members' => 20
                        ],
                        // ошибки в вычислениях (деление)
                        // ex_ecd_cm
                        // ex_ecd_pm
                        'errors_in_calculation_division' => [
                            'count_members' => 1,
                            'percentage_members' => 20
                        ],
                        // не приступили к решению
                        // ex_wr_cm
                        // ex_wr_pm
                        'without_realize' => [
                            'count_members' => 1,
                            'percentage_members' => 20
                        ]
                    ],
                    // Сравнение
                    'comparison' => [
                        // выполнили  задание правильно
                        // co_woe_cm
                        // co_woe_pm
                        'without_errors' => [
                            'count_members' => 1,
                            'percentage_members' => 20
                        ],
                        // чисел
                        // co_n_cm
                        // co_n_pm
                        'numbers' => [
                            'count_members' => 1,
                            'percentage_members' => 20
                        ],
                        // числовых выражений
                        // co_ne_cm
                        // co_ne_pm
                        'numeric_expressions' => [
                            'count_members' => 1,
                            'percentage_members' => 20
                        ],
                        // десятичного состава числа и числа
                        // co_dcn_cm
                        // co_dcn_pm
                        'decimal_composition_of_numbers' => [
                            'count_members' => 1,
                            'percentage_members' => 20
                        ],
                        // выражения и числа
                        // co_en_cm
                        // co_en_pm
                        'expressions_numbers' => [
                            'count_members' => 1,
                            'percentage_members' => 20
                        ],
                        // величин длины
                        // co_lv_cm
                        // co_lv_pm
                        'length_values' => [
                            'count_members' => 1,
                            'percentage_members' => 20
                        ],
                        // величин массы
                        // co_mv_cm
                        // co_mv_pm
                        'mass_values' => [
                            'count_members' => 1,
                            'percentage_members' => 20
                        ],
                        // величин времени
                        // co_tv_cm
                        // co_tv_pm
                        'time_values' => [
                            'count_members' => 1,
                            'percentage_members' => 20
                        ],
                        // не приступили к решению
                        // co_wr_cm
                        // co_wr_pm
                        'without_realize' => [
                            'count_members' => 1,
                            'percentage_members' => 20
                        ]
                    ],
                    // Задача
                    'task' => [
                        // выполнили  задание правильно
                        // t_woe_cm
                        // t_woe_pm
                        'without_errors' => [
                            'count_members' => 1,
                            'percentage_members' => 20
                        ],
                        // ошибки в ходе решения
                        // t_dd_cm
                        // t_dd_pm
                        'during_decision' => [
                            'count_members' => 1,
                            'percentage_members' => 20
                        ],
                        // ошибки в вычислениях
                        // t_dc_cm
                        // t_dc_pm
                        'during_calculation' => [
                            'count_members' => 1,
                            'percentage_members' => 20
                        ],
                        // не приступили к решению
                        // t_wr_cm
                        // t_wr_pm
                        'without_realize' => [
                            'count_members' => 1,
                            'percentage_members' => 20
                        ]
                    ],
                    // Геометрическая задача
                    'geometric_task' => [
                        // выполнили  задание правильно
                        // gt_woe_cm
                        // gt_woe_pm
                        'without_errors' => [
                            'count_members' => 1,
                            'percentage_members' => 20
                        ],
                        // ошибки в ходе решения
                        // gt_dd_cm
                        // gt_dd_pm
                        'during_decision' => [
                            'count_members' => 1,
                            'percentage_members' => 20
                        ],
                        // ошибки в вычислениях
                        // gt_dc_cm
                        // gt_dc_pm
                        'during_calculation' => [
                            'count_members' => 1,
                            'percentage_members' => 20
                        ],
                        // ошибки в выполнении чертежа
                        // gt_ded_cm
                        // gt_ded_pm
                        'during_execution_drawing' => [
                            'count_members' => 1,
                            'percentage_members' => 20
                        ],
                        // не приступили к решению
                        // gt_wr_cm
                        // gt_wr_pm
                        'without_realize' => [
                            'count_members' => 1,
                            'percentage_members' => 20
                        ]
                    ],
                    // Перевод величин
                    'conversion' => [
                        // выполнили  задание правильно
                        // cv_woe_cm
                        // cv_woe_pm
                        'without_errors' => [
                            'count_members' => 1,
                            'percentage_members' => 20
                        ],
                        // длина
                        // cv_l_cm
                        // cv_l_pm
                        'length' => [
                            'count_members' => 1,
                            'percentage_members' => 20
                        ],
                        // масса
                        // cv_m_cm
                        // cv_m_pm
                        'mass' => [
                            'count_members' => 1,
                            'percentage_members' => 20
                        ],
                        // время
                        // cv_t_cm
                        // cv_t_pm
                        'time' => [
                            'count_members' => 1,
                            'percentage_members' => 20
                        ],
                        // не приступили к решению
                        // cv_wr_cm
                        // cv_wr_pm
                        'without_realize' => [
                            'count_members' => 1,
                            'percentage_members' => 20
                        ]
                    ],
                    // Исправления
                    // fx_cm
                    // fx_pm
                    'fixes' => [
                        'count_members' => 1,
                        'percentage_members' => 20
                    ],
                ],
                'extra' => [
                    // xtr_tq
                    // xtr_p
                    ['theme_questions' => 'Сравнение двузначных чисел', 'pupil' => 'Георгий Корешков'],
                    ['theme_questions' => 'Деление двузначных чисел', 'pupil' => 'Георгий Корешков']
                ],
                'execution_analyze' => [
                    // exa_on - order number
                    // exa_p
                    // exa_r
                    ['pupil' => 'Глафира Подоляко', 'result' => 'Без ошибок'],
                    ['pupil' => 'Феофан Артамонов', 'result' => '2 ошибки'],
                    ['pupil' => 'Иван Сидоров', 'result' => '1 ошибка'],
                    ['pupil' => 'Георгий Корешков', 'result' => '4 ошибки'],
                    ['pupil' => 'Валентина Смолячкова', 'result' => '1 ошибка'],
                ]
            ]
        ];
        return $input;
    }

    public function test_download()
    {
        $templateFileName = 'math_4.docx';
        $templatePath = public_path('templates');
        $templateFile = $templatePath . '/' . $templateFileName;
        $document = new TemplateProcessor($templateFile);

        $data = $this->getDownloadData();
        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                $document->setValue($key, $value);
            }
        }

        header('Content-Description: File Transfer');
        header('Content-Disposition: attachment; filename="' . $templateFileName . '"');
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Expires: 0');

        $document->saveAs("php://output");
    }

    private function getDownloadData(): array
    {
        $count_pupils = 28;
        $count_members = 25;

        $ranges = [
            'cm_10' => 12, 'pm_10' => $this->getPercent($count_members, 12),
            'cm_9' => 3, 'pm_9' => $this->getPercent($count_members, 3),
            'cm_8' => 1, 'pm_8' => $this->getPercent($count_members, 1),
            'cm_7' => 4, 'pm_7' => $this->getPercent($count_members, 4),
            'cm_6' => 3, 'pm_6' => $this->getPercent($count_members, 3),
            'cm_5' => 1, 'pm_5' => $this->getPercent($count_members, 1),
            'cm_4' => 1, 'pm_4' => $this->getPercent($count_members, 1),
            'cm_3' => 0, 'pm_3' => $this->getPercent($count_members, 0),
            'cm_2' => 0, 'pm_2' => $this->getPercent($count_members, 0),
            'cm_1' => 0, 'pm_1' => $this->getPercent($count_members, 0)
        ];
        $average_range = $this->getAverage($ranges, $count_members);

        $level = [
            'count_level_high' => 15, 'percentage_level_high' => $this->getPercent($count_members, 15),
            'count_level_enough' => 5, 'percentage_level_enough' => $this->getPercent($count_members, 5),
            'count_level_middle' => 4, 'percentage_level_middle' => $this->getPercent($count_members, 4),
            'count_level_satisfying' => 1, 'percentage_level_satisfying' => $this->getPercent($count_members, 1),
            'count_level_low' => 0, 'percentage_level_low' => $this->getPercent($count_members, 0)
        ];

        $task_analyze = [
            'eq_woe_cm' => 3, 'eq_woe_pm' => $this->getPercent($count_members, 3),
            'eq_we_cm' => 8, 'eq_we_pm' => $this->getPercent($count_members, 8),
            'eq_wr_cm' => 1, 'eq_wr_pm' => $this->getPercent($count_members, 1),

            'ex_woe_cm' => 4, 'ex_woe_pm' => $this->getPercent($count_members, 4),
            'ex_we_cm' => 5, 'ex_we_pm' => $this->getPercent($count_members, 5),
            'ex_wr_cm' => 0, 'ex_wr_pm' => $this->getPercent($count_members, 0),

            'co_woe_cm' => 3, 'co_woe_pm' => $this->getPercent($count_members, 3),
            'co_we_cm' => 4, 'co_we_pm' => $this->getPercent($count_members, 4),
            'co_wr_cm' => 0, 'co_wr_pm' => $this->getPercent($count_members, 0),

            't_woe_cm' => 10, 't_woe_pm' => $this->getPercent($count_members, 10),
            't_we_cm' => 4, 't_we_pm' => $this->getPercent($count_members, 4),
            't_wr_cm' => 1, 't_wr_pm' => $this->getPercent($count_members, 1),

            'gt_woe_cm' => 6, 'gt_woe_pm' => $this->getPercent($count_members, 6),
            'gt_we_cm' => 11, 'gt_we_pm' => $this->getPercent($count_members, 11),
            'gt_wr_cm' => 4, 'gt_wr_pm' => $this->getPercent($count_members, 4),

            'f_woe_cm' => 14, 'f_woe_pm' => $this->getPercent($count_members, 14),
            'f_we_cm' => 9, 'f_we_pm' => $this->getPercent($count_members, 9),
            'f_wr_cm' => 2, 'f_wr_pm' => $this->getPercent($count_members, 2),
        ];

        $full_analyze = [
            'eq_woe_cm' => 16, 'eq_woe_pm' => $this->getPercent($count_members, 16),
            'eq_eis_cm' => 6, 'eq_eis_pm' => $this->getPercent($count_members, 6),
            'eq_eic_cm' => 3, 'eq_eic_pm' => $this->getPercent($count_members, 3),
            'eq_wr_cm' => 0, 'eq_wr_pm' => $this->getPercent($count_members, 0),
            'ex_woe_cm' => 9, 'ex_woe_pm' => $this->getPercent($count_members, 9),
            'ex_eio_cm' => 4, 'ex_eio_pm' => $this->getPercent($count_members, 4),
            'ex_eca_cm' => 2, 'ex_eca_pm' => $this->getPercent($count_members, 2),
            'ex_ecs_cm' => 1, 'ex_ecs_pm' => $this->getPercent($count_members, 1),
            'ex_ecm_cm' => 1, 'ex_ecm_pm' => $this->getPercent($count_members, 1),
            'ex_ecd_cm' => 5, 'ex_ecd_pm' => $this->getPercent($count_members, 5),
            'ex_wr_cm' => 0, 'ex_wr_pm' => $this->getPercent($count_members, 0),
            'co_woe_cm' => 7, 'co_woe_pm' => $this->getPercent($count_members, 7),
            'co_n_cm' => 3, 'co_n_pm' => $this->getPercent($count_members, 3),
            'co_ne_cm' => 2, 'co_ne_pm' => $this->getPercent($count_members, 2),
            'co_dcn_cm' => 10, 'co_dcn_pm' => $this->getPercent($count_members, 10),
            'co_en_cm' => 4, 'co_en_pm' => $this->getPercent($count_members, 4),
            'co_lv_cm' => 3, 'co_lv_pm' => $this->getPercent($count_members, 3),
            'co_mv_cm' => 1, 'co_mv_pm' => $this->getPercent($count_members, 1),
            'co_tv_cm' => 2, 'co_tv_pm' => $this->getPercent($count_members, 2),
            'co_wr_cm' => 0, 'co_wr_pm' => $this->getPercent($count_members, 0),
            't_woe_cm' => 4, 't_woe_pm' => $this->getPercent($count_members, 4),
            't_dd_cm' => 3, 't_dd_pm' => $this->getPercent($count_members, 3),
            't_dc_cm' => 0, 't_dc_pm' => $this->getPercent($count_members, 0),
            't_wr_cm' => 1, 't_wr_pm' => $this->getPercent($count_members, 1),
            'gt_woe_cm' => 5, 'gt_woe_pm' => $this->getPercent($count_members, 5),
            'gt_dd_cm' => 3, 'gt_dd_pm' => $this->getPercent($count_members, 3),
            'gt_dc_cm' => 1, 'gt_dc_pm' => $this->getPercent($count_members, 1),
            'gt_ded_cm' => 1, 'gt_ded_pm' => $this->getPercent($count_members, 1),
            'gt_wr_cm' => 0, 'gt_wr_pm' => $this->getPercent($count_members, 0),
            'cv_woe_cm' => 7, 'cv_woe_pm' => $this->getPercent($count_members, 7),
            'cv_l_cm' => 3, 'cv_l_pm' => $this->getPercent($count_members, 3),
            'cv_m_cm' => 2, 'cv_m_pm' => $this->getPercent($count_members, 2),
            'cv_t_cm' => 2, 'cv_t_pm' => $this->getPercent($count_members, 2),
            'cv_wr_cm' => 0, 'cv_wr_pm' => $this->getPercent($count_members, 0),
            'fx_cm' => 65, 'fx_pm' => $this->getPercent($count_members, 65),
        ];

        $questions = [
            ['xtr_tq' => 'Повторить умножение двузначных чисел', 'xtr_p' => 'Смолячкова Валентина'],
        ];

        $personal_analyzis = [
            ['exa_p' => 'Подоляко Глафира', 'exa_r' => '25/3'],
            ['exa_p' => 'Артамонов Феофан', 'exa_r' => '20/8'],
            ['exa_p' => 'Сидоров Иван', 'exa_r' => '16/7'],
            ['exa_p' => 'Корешков Георгий', 'exa_r' => '14/8'],
            ['exa_p' => 'Смолячкова Валентина', 'exa_r' => '11/9'],
        ];

        return [

            'group' => '4 "Д"',
            'theme' => 'Основы развития современного общества под давлением информационных технологий',
            'date' => '18.01.2023',
            'teacher' => 'Самойлова Татьяна',
            'count_pupils' => $count_pupils,
            'count_members' => $count_members,

            'average_range' => $average_range


        ] + $ranges + $level + $task_analyze + $full_analyze + $questions + $personal_analyzis;
    }

    private function getPercent(int $total = 0, int $part = 0)
    {
        if ($total > 0) {
            if ($part > 0) {
                $result = $part / $total * 100;
                return round($result, 2);
            }
        }

        return 0;
    }

    private function getAverage(array $ranges, int $count_members)
    {
        $total = 0;
        foreach ($ranges as $key => $value) {
            if (strpos($key, 'cm_') !== false) {
                switch ($key) {
                    case 'cm_10': $total = $this->getAVG($total, 10, $value); break;
                    case 'cm_9': $total = $this->getAVG($total, 9, $value); break;
                    case 'cm_8': $total = $this->getAVG($total, 8, $value); break;
                    case 'cm_7': $total = $this->getAVG($total, 7, $value); break;
                    case 'cm_6': $total = $this->getAVG($total, 6, $value); break;
                    case 'cm_5': $total = $this->getAVG($total, 5, $value); break;
                    case 'cm_4': $total = $this->getAVG($total, 4, $value); break;
                    case 'cm_3': $total = $this->getAVG($total, 3, $value); break;
                    case 'cm_2': $total = $this->getAVG($total, 2, $value); break;
                    case 'cm_1': $total = $this->getAVG($total, 1, $value); break;
                }
            }
        }

        if ($total > 0) {
            if ($count_members > 0) {
                return ceil($total / $count_members);
            }
        }

        return 0;
    }

    private function getAVG(int $total, int $range, int $value = 0)
    {
        if ($value > 0) {
            return $total + ($range * $value);
        }

        return $total;
    }
}
