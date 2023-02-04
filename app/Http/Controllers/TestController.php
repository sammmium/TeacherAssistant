<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;

class TestController extends Controller
{
    public function index()
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
            'test' => [
                'id' => '168',
                'template' => 4,
                'theme' => 'Тестовая тема',
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
        return view('test.index', $input);
    }

    public function card(int $id)
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
            'test' => [
                'id' => '168',
                'template' => 4,
                'theme' => 'Тестовая тема',
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
        return view('test.card', $input);
    }

    public function download()
    {
        $templateFileName = 'math_4.docx';
        $templatePath = public_path('templates');
        $templateFile = $templatePath . '/' . $templateFileName;
        $document = new TemplateProcessor($templateFile);

//        $document = new \PhpOffice\PhpWord\TemplateProcessor('templates\test.docx');

        $document->setValue('group', 'Артём');
        $document->setValue('theme', 'солнце');
        $document->setValue('teacher', 'небо');

        header("Content-Description: File Transfer");
        header('Content-Disposition: attachment; filename="' . $templateFileName . '"');
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Expires: 0');

        $document->saveAs("php://output");
    }

    public function store(Request $request)
    {
        var_dump($request->all());exit;
    }
}
