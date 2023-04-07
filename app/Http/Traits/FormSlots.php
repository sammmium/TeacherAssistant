<?php

namespace App\Http\Traits;

trait FormSlots
{
    protected $slots = [
        'math' => [
            1 => [
                'mkr' => [
                    'range' => [ // Оценка
                        'type' => 'text', 'placeholder' => 'Оценка',
                    ],

                    'task1' => [ // Calculations for tabular addition and subtraction within 10
                        'type' => 'text', 'placeholder' => 'Вычисления на табличное сложение и вычитание в пределах 10',
                    ],
                    'task1_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task1_we_apb' => [ // a + b
                        'type' => 'checkbox', 'placeholder' => 'a + b',
                    ],
                    'task1_we_amb' => [ // a - b
                        'type' => 'checkbox', 'placeholder' => 'а - b',
                    ],
                    'task1_we_apmb' => [ // а +(-) b
                        'type' => 'checkbox', 'placeholder' => 'а +(-) b',
                    ],
                    'task1_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task2' => [ // Number series
                        'type' => 'text', 'placeholder' => 'Числовой ряд',
                    ],
                    'task2_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task1_we' => [ // with errors
                        'type' => 'checkbox', 'placeholder' => 'допущены ошибки',
                    ],
                    'task2_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task3' => [ // Comparison
                        'type' => 'text', 'placeholder' => 'Сравнение',
                    ],
                    'task3_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task3_we_n' => [ // numbers
                        'type' => 'checkbox', 'placeholder' => 'чисел',
                    ],
                    'task3_we_ne' => [ // numeric expressions
                        'type' => 'checkbox', 'placeholder' => 'числовых выражений',
                    ],
                    'task3_we_en' => [ // expressions and numbers
                        'type' => 'checkbox', 'placeholder' => 'выражения и числа',
                    ],
                    'task3_we_dcn' => [ // decimal composition of numbers and numbers
                        'type' => 'checkbox', 'placeholder' => 'десятичного состава числа и числа',
                    ],
                    'task3_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task4' => [ // Task
                        'type' => 'text', 'placeholder' => 'Задача',
                    ],
                    'task4_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task4_we_eis' => [ // errors in the solution
                        'type' => 'checkbox', 'placeholder' => 'ошибки в ходе решения',
                    ],
                    'task4_we_eic' => [ // errors in calculations
                        'type' => 'checkbox', 'placeholder' => 'ошибки в вычислениях',
                    ],
                    'task4_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task5' => [ // Geometric task
                        'type' => 'text', 'placeholder' => 'Геометрическая задача',
                    ],
                    'task5_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task5_we_eis' => [ // errors in the solution
                        'type' => 'checkbox', 'placeholder' => 'ошибки в ходе решения',
                    ],
                    'task5_we_eic' => [ // errors in calculations
                        'type' => 'checkbox', 'placeholder' => 'ошибки в вычислениях',
                    ],
                    'task5_we_se' => [ // segmentation errors
                        'type' => 'checkbox', 'placeholder' => 'ошибки в построении отрезков',
                    ],
                    'task5_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task6' => [ // Finding an unknown component
                        'type' => 'text', 'placeholder' => 'Нахождение неизвестной компоненты',
                    ],
                    'task6_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task6_we_eis' => [ // errors in the solution
                        'type' => 'checkbox', 'placeholder' => 'ошибки в ходе решения',
                    ],
                    'task6_we_eic' => [ // errors in calculations
                        'type' => 'checkbox', 'placeholder' => 'ошибки в вычислениях',
                    ],
                    'task6_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task7' => [ // Writing numbers
                        'type' => 'checkbox', 'placeholder' => 'Написание цифр',
                    ],

                    'fixes' => [ // Fixes
                        'type' => 'checkbox', 'placeholder' => 'Исправления',
                    ],
                ],

                'mkus' => [
                    'range' => [ // Оценка
                        'type' => 'text', 'placeholder' => 'Оценка',
                    ],

                    'task1' => [ // Task
                        'type' => 'text', 'placeholder' => 'Задание 1',
                    ],
                    'task1_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task1_we' => [ // with errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено с ошибками',
                    ],
                    'task1_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task2' => [ // Task
                        'type' => 'text', 'placeholder' => 'Задание 2',
                    ],
                    'task2_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task2_we' => [ // with errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено с ошибками',
                    ],
                    'task2_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task3' => [ // Task
                        'type' => 'text', 'placeholder' => 'Задание 3',
                    ],
                    'task3_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task3_we' => [ // with errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено с ошибками',
                    ],
                    'task3_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task4' => [ // Task
                        'type' => 'text', 'placeholder' => 'Задание 4',
                    ],
                    'task4_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task4_we' => [ // with errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено с ошибками',
                    ],
                    'task4_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task5' => [ // Task
                        'type' => 'text', 'placeholder' => 'Задание 5',
                    ],
                    'task5_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task5_we' => [ // with errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено с ошибками',
                    ],
                    'task5_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task6' => [ // Task
                        'type' => 'text', 'placeholder' => 'Задание 6',
                    ],
                    'task6_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task6_we' => [ // with errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено с ошибками',
                    ],
                    'task6_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task7' => [ // Task
                        'type' => 'text', 'placeholder' => 'Задание 7',
                    ],
                    'task7_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task7_we' => [ // with errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено с ошибками',
                    ],
                    'task7_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task8' => [ // Task
                        'type' => 'text', 'placeholder' => 'Задание 8',
                    ],
                    'task8_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task8_we' => [ // with errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено с ошибками',
                    ],
                    'task8_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task9' => [ // Task
                        'type' => 'text', 'placeholder' => 'Задание 9',
                    ],
                    'task9_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task9_we' => [ // with errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено с ошибками',
                    ],
                    'task9_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task10' => [ // Task
                        'type' => 'text', 'placeholder' => 'Задание 10',
                    ],
                    'task10_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task10_we' => [ // with errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено с ошибками',
                    ],
                    'task10_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],
                ],
            ],

            2 => [
                'mkr' => [
                    'range' => [ // Оценка
                        'type' => 'text', 'placeholder' => 'Оценка',
                    ],

                    'task1' => [ // Written and oral methods
                        'type' => 'text', 'placeholder' => 'Письменные и устные приёмы',
                    ],
                    'task1_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task1_we_awoco' => [ // addition without crossing over
                        'type' => 'checkbox', 'placeholder' => 'сложение без перехода через разряд',
                    ],
                    'task1_we_awttd' => [ // addition with transition through the discharge
                        'type' => 'checkbox', 'placeholder' => 'сложение с переходом через разряд',
                    ],
                    'task1_we_swojtd' => [ // subtraction without jumping through the digit
                        'type' => 'checkbox', 'placeholder' => 'вычитание  без перехода через разряд',
                    ],
                    'task1_we_js' => [ // jump subtraction
                        'type' => 'checkbox', 'placeholder' => 'вычитание с переходом через разряд',
                    ],
                    'task1_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task2' => [ // Expression solving
                        'type' => 'text', 'placeholder' => 'Решение выражений',
                    ],
                    'task2_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task2_we_eio' => [ // errors in the order
                        'type' => 'checkbox', 'placeholder' => 'ошибки в порядке действий',
                    ],
                    'task2_we_eic' => [ // errors in calculations
                        'type' => 'checkbox', 'placeholder' => 'ошибки в вычислениях',
                    ],
                    'task2_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task3' => [ // Comparison
                        'type' => 'text', 'placeholder' => 'Сравнение',
                    ],
                    'task3_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task3_we_n' => [ // numbers
                        'type' => 'checkbox', 'placeholder' => 'чисел',
                    ],
                    'task3_we_ne' => [ // numeric expressions
                        'type' => 'checkbox', 'placeholder' => 'числовых выражений',
                    ],
                    'task3_we_en' => [ // expressions and numbers
                        'type' => 'checkbox', 'placeholder' => 'выражения и числа',
                    ],
                    'task3_we_lv' => [ // length values
                        'type' => 'checkbox', 'placeholder' => 'величин длины',
                    ],
                    'task3_we_tv' => [ // time values
                        'type' => 'checkbox', 'placeholder' => 'величин времени',
                    ],
                    'task3_we_dcn' => [ // decimal composition of numbers and numbers
                        'type' => 'checkbox', 'placeholder' => 'десятичного состава числа и числа',
                    ],
                    'task3_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task4' => [ // Task
                        'type' => 'text', 'placeholder' => 'Задача',
                    ],
                    'task4_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task4_we_eis' => [ // errors in the solution
                        'type' => 'checkbox', 'placeholder' => 'ошибки в ходе решения',
                    ],
                    'task4_we_eic' => [ // errors in calculations
                        'type' => 'checkbox', 'placeholder' => 'ошибки в вычислениях',
                    ],
                    'task4_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task5' => [ // Geometric task
                        'type' => 'text', 'placeholder' => 'Геометрическая задача',
                    ],
                    'task5_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task5_we_eis' => [ // errors in the solution
                        'type' => 'checkbox', 'placeholder' => 'ошибки в ходе решения',
                    ],
                    'task5_we_eic' => [ // errors in calculations
                        'type' => 'checkbox', 'placeholder' => 'ошибки в вычислениях',
                    ],
                    'task5_we_se' => [ // segmentation errors
                        'type' => 'checkbox', 'placeholder' => 'ошибки в построении отрезков',
                    ],
                    'task5_we_eicgs' => [ // errors in the construction of geometric shapes
                        'type' => 'checkbox', 'placeholder' => 'ошибки в построении геометрических фигур',
                    ],
                    'task5_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task6' => [ // Solution
                        'type' => 'text', 'placeholder' => 'Решение',
                    ],
                    'task6_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task6_we_eis' => [ // errors in the solution
                        'type' => 'checkbox', 'placeholder' => 'ошибки в ходе решения',
                    ],
                    'task6_we_eic' => [ // errors in calculations
                        'type' => 'checkbox', 'placeholder' => 'ошибки в вычислениях',
                    ],
                    'task6_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task7' => [ // Writing numbers
                        'type' => 'checkbox', 'placeholder' => 'Написание цифр',
                    ],

                    'fixes' => [ // Fixes
                        'type' => 'checkbox', 'placeholder' => 'Исправления',
                    ],
                ],

                'mkus' => [
                    'range' => [ // Оценка
                        'type' => 'text', 'placeholder' => 'Оценка',
                    ],

                    'task1' => [ // Task
                        'type' => 'text', 'placeholder' => 'Задание 1',
                    ],
                    'task1_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task1_we' => [ // with errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено с ошибками',
                    ],
                    'task1_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task2' => [ // Task
                        'type' => 'text', 'placeholder' => 'Задание 2',
                    ],
                    'task2_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task2_we' => [ // with errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено с ошибками',
                    ],
                    'task2_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task3' => [ // Task
                        'type' => 'text', 'placeholder' => 'Задание 3',
                    ],
                    'task3_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task3_we' => [ // with errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено с ошибками',
                    ],
                    'task3_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task4' => [ // Task
                        'type' => 'text', 'placeholder' => 'Задание 4',
                    ],
                    'task4_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task4_we' => [ // with errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено с ошибками',
                    ],
                    'task4_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task5' => [ // Task
                        'type' => 'text', 'placeholder' => 'Задание 5',
                    ],
                    'task5_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task5_we' => [ // with errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено с ошибками',
                    ],
                    'task5_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task6' => [ // Task
                        'type' => 'text', 'placeholder' => 'Задание 6',
                    ],
                    'task6_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task6_we' => [ // with errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено с ошибками',
                    ],
                    'task6_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task7' => [ // Task
                        'type' => 'text', 'placeholder' => 'Задание 7',
                    ],
                    'task7_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task7_we' => [ // with errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено с ошибками',
                    ],
                    'task7_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task8' => [ // Task
                        'type' => 'text', 'placeholder' => 'Задание 8',
                    ],
                    'task8_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task8_we' => [ // with errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено с ошибками',
                    ],
                    'task8_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task9' => [ // Task
                        'type' => 'text', 'placeholder' => 'Задание 9',
                    ],
                    'task9_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task9_we' => [ // with errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено с ошибками',
                    ],
                    'task9_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task10' => [ // Task
                        'type' => 'text', 'placeholder' => 'Задание 10',
                    ],
                    'task10_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task10_we' => [ // with errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено с ошибками',
                    ],
                    'task10_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],
                ],
            ],

            3 => [
                'mkr' => [
                    'range' => [ // Оценка
                        'type' => 'text', 'placeholder' => 'Оценка',
                    ],

                    'task1' => [
                        'type' => 'text', 'placeholder' => 'Решение уравнений',
                    ],
                    'task1_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task1_we_eis' => [ // errors in solution
                        'type' => 'checkbox', 'placeholder' => 'ошибки в ходе решения',
                    ],
                    'task1_we_eic' => [ // errors in calculations
                        'type' => 'checkbox', 'placeholder' => 'ошибки в вычислениях',
                    ],
                    'task1_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task2' => [ // Expression
                        'type' => 'text', 'placeholder' => 'Решение выражений',
                    ],
                    'task2_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task2_we_eio' => [ // errors in the order
                        'type' => 'checkbox', 'placeholder' => 'ошибки в порядке действий',
                    ],
                    'task2_we_cea' => [ // calculation errors (addition)
                        'type' => 'checkbox', 'placeholder' => 'ошибки в вычислениях (сложение)',
                    ],
                    'task2_we_ces' => [ // errors in calculations (subtraction)
                        'type' => 'checkbox', 'placeholder' => 'ошибки в вычислениях (вычитание)',
                    ],
                    'task2_we_cem' => [ // errors in calculations (multiplication)
                        'type' => 'checkbox', 'placeholder' => 'ошибки в вычислениях (умножение)',
                    ],
                    'task2_we_ced' => [ // errors in calculations (division)
                        'type' => 'checkbox', 'placeholder' => 'ошибки в вычислениях (деление)',
                    ],
                    'task2_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task3' => [ // Comparison
                        'type' => 'text', 'placeholder' => 'Сравнение',
                    ],
                    'task3_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task3_we_n' => [ // numbers
                        'type' => 'checkbox', 'placeholder' => 'чисел',
                    ],
                    'task3_we_ne' => [ // numeric expressions
                        'type' => 'checkbox', 'placeholder' => 'числовых выражений',
                    ],
                    'task3_we_dcn' => [ // decimal composition of numbers and numbers
                        'type' => 'checkbox', 'placeholder' => 'десятичного состава числа и числа',
                    ],
                    'task3_we_en' => [ // expressions and numbers
                        'type' => 'checkbox', 'placeholder' => 'выражения и числа',
                    ],
                    'task3_we_lv' => [ // length values
                        'type' => 'checkbox', 'placeholder' => 'величин длины',
                    ],
                    'task3_we_mv' => [ // mass values
                        'type' => 'checkbox', 'placeholder' => 'величин массы',
                    ],
                    'task3_we_tv' => [ // time values
                        'type' => 'checkbox', 'placeholder' => 'величин времени',
                    ],
                    'task3_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task4' => [ // Task
                        'type' => 'text', 'placeholder' => 'Задача',
                    ],
                    'task4_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task4_we_eis' => [ // errors in the solution
                        'type' => 'checkbox', 'placeholder' => 'ошибки в ходе решения',
                    ],
                    'task4_we_eic' => [ // errors in calculations
                        'type' => 'checkbox', 'placeholder' => 'ошибки в вычислениях',
                    ],
                    'task4_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task5' => [ // Geometric task
                        'type' => 'text', 'placeholder' => 'Геометрическая задача',
                    ],
                    'task5_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task5_we_eis' => [ // errors in the solution
                        'type' => 'checkbox', 'placeholder' => 'ошибки в ходе решения',
                    ],
                    'task5_we_eic' => [ // errors in calculations
                        'type' => 'checkbox', 'placeholder' => 'ошибки в вычислениях',
                    ],
                    'task5_we_de' => [ // drawing errors
                        'type' => 'checkbox', 'placeholder' => 'ошибки в выполнении чертежа',
                    ],
                    'task5_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task6' => [ // Conversion
                        'type' => 'text', 'placeholder' => 'Перевод величин',
                    ],
                    'task6_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task6_we_l' => [ // length
                        'type' => 'checkbox', 'placeholder' => 'длина',
                    ],
                    'task6_we_w' => [ // weight
                        'type' => 'checkbox', 'placeholder' => 'масса',
                    ],
                    'task6_we_t' => [ // time
                        'type' => 'checkbox', 'placeholder' => 'время',
                    ],
                    'task6_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'fixes' => [ // Fixes
                        'type' => 'checkbox', 'placeholder' => 'Исправления',
                    ],
                ],

                'mkus' => [
                    'range' => [ // Оценка
                        'type' => 'text', 'placeholder' => 'Оценка',
                    ],

                    'task1' => [ // Task
                        'type' => 'text', 'placeholder' => 'Задание 1',
                    ],
                    'task1_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task1_we' => [ // with errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено с ошибками',
                    ],
                    'task1_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task2' => [ // Task
                        'type' => 'text', 'placeholder' => 'Задание 2',
                    ],
                    'task2_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task2_we' => [ // with errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено с ошибками',
                    ],
                    'task2_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task3' => [ // Task
                        'type' => 'text', 'placeholder' => 'Задание 3',
                    ],
                    'task3_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task3_we' => [ // with errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено с ошибками',
                    ],
                    'task3_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task4' => [ // Task
                        'type' => 'text', 'placeholder' => 'Задание 4',
                    ],
                    'task4_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task4_we' => [ // with errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено с ошибками',
                    ],
                    'task4_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task5' => [ // Task
                        'type' => 'text', 'placeholder' => 'Задание 5',
                    ],
                    'task5_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task5_we' => [ // with errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено с ошибками',
                    ],
                    'task5_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task6' => [ // Task
                        'type' => 'text', 'placeholder' => 'Задание 6',
                    ],
                    'task6_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task6_we' => [ // with errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено с ошибками',
                    ],
                    'task6_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task7' => [ // Task
                        'type' => 'text', 'placeholder' => 'Задание 7',
                    ],
                    'task7_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task7_we' => [ // with errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено с ошибками',
                    ],
                    'task7_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task8' => [ // Task
                        'type' => 'text', 'placeholder' => 'Задание 8',
                    ],
                    'task8_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task8_we' => [ // with errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено с ошибками',
                    ],
                    'task8_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task9' => [ // Task
                        'type' => 'text', 'placeholder' => 'Задание 9',
                    ],
                    'task9_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task9_we' => [ // with errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено с ошибками',
                    ],
                    'task9_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task10' => [ // Task
                        'type' => 'text', 'placeholder' => 'Задание 10',
                    ],
                    'task10_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task10_we' => [ // with errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено с ошибками',
                    ],
                    'task10_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],
                ],
            ],

            4 => [
                'mkr' => [
                    'range' => [ // Оценка
                        'type' => 'text', 'placeholder' => 'Оценка',
                    ],

                    'task1' => [
                        'type' => 'text', 'placeholder' => 'Решение уравнений',
                    ],
                    'task1_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task1_we_eis' => [ // errors in solution
                        'type' => 'checkbox', 'placeholder' => 'ошибки в ходе решения',
                    ],
                    'task1_we_eic' => [ // errors in calculations
                        'type' => 'checkbox', 'placeholder' => 'ошибки в вычислениях',
                    ],
                    'task1_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task2' => [ // Expression
                        'type' => 'text', 'placeholder' => 'Решение выражений',
                    ],
                    'task2_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task2_we_eio' => [ // errors in the order
                        'type' => 'checkbox', 'placeholder' => 'ошибки в порядке действий',
                    ],
                    'task2_we_cea' => [ // calculation errors (addition)
                        'type' => 'checkbox', 'placeholder' => 'ошибки в вычислениях (сложение)',
                    ],
                    'task2_we_ces' => [ // errors in calculations (subtraction)
                        'type' => 'checkbox', 'placeholder' => 'ошибки в вычислениях (вычитание)',
                    ],
                    'task2_we_cem' => [ // errors in calculations (multiplication)
                        'type' => 'checkbox', 'placeholder' => 'ошибки в вычислениях (умножение)',
                    ],
                    'task2_we_ced' => [ // errors in calculations (division)
                        'type' => 'checkbox', 'placeholder' => 'ошибки в вычислениях (деление)',
                    ],
                    'task2_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task3' => [ // Comparison
                        'type' => 'text', 'placeholder' => 'Сравнение',
                    ],
                    'task3_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task3_we_n' => [ // numbers
                        'type' => 'checkbox', 'placeholder' => 'чисел',
                    ],
                    'task3_we_ne' => [ // numeric expressions
                        'type' => 'checkbox', 'placeholder' => 'числовых выражений',
                    ],
                    'task3_we_dcn' => [ // decimal composition of numbers and numbers
                        'type' => 'checkbox', 'placeholder' => 'десятичного состава числа и числа',
                    ],
                    'task3_we_en' => [ // expressions and numbers
                        'type' => 'checkbox', 'placeholder' => 'выражения и числа',
                    ],
                    'task3_we_lv' => [ // length values
                        'type' => 'checkbox', 'placeholder' => 'величин длины',
                    ],
                    'task3_we_mv' => [ // mass values
                        'type' => 'checkbox', 'placeholder' => 'величин массы',
                    ],
                    'task3_we_tv' => [ // time values
                        'type' => 'checkbox', 'placeholder' => 'величин времени',
                    ],
                    'task3_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task4' => [ // Task
                        'type' => 'text', 'placeholder' => 'Задача',
                    ],
                    'task4_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task4_we_eis' => [ // errors in the solution
                        'type' => 'checkbox', 'placeholder' => 'ошибки в ходе решения',
                    ],
                    'task4_we_eic' => [ // errors in calculations
                        'type' => 'checkbox', 'placeholder' => 'ошибки в вычислениях',
                    ],
                    'task4_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task5' => [ // Geometric task
                        'type' => 'text', 'placeholder' => 'Геометрическая задача',
                    ],
                    'task5_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task5_we_eis' => [ // errors in the solution
                        'type' => 'checkbox', 'placeholder' => 'ошибки в ходе решения',
                    ],
                    'task5_we_eic' => [ // errors in calculations
                        'type' => 'checkbox', 'placeholder' => 'ошибки в вычислениях',
                    ],
                    'task5_we_de' => [ // drawing errors
                        'type' => 'checkbox', 'placeholder' => 'ошибки в выполнении чертежа',
                    ],
                    'task5_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task6' => [ // Conversion
                        'type' => 'text', 'placeholder' => 'Перевод величин',
                    ],
                    'task6_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task6_we_l' => [ // length
                        'type' => 'checkbox', 'placeholder' => 'длина',
                    ],
                    'task6_we_w' => [ // weight
                        'type' => 'checkbox', 'placeholder' => 'масса',
                    ],
                    'task6_we_t' => [ // time
                        'type' => 'checkbox', 'placeholder' => 'время',
                    ],
                    'task6_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'fixes' => [ // Fixes
                        'type' => 'checkbox', 'placeholder' => 'Исправления',
                    ],
                ],

                'mkus' => [
                    'range' => [ // Оценка
                        'type' => 'text', 'placeholder' => 'Оценка',
                    ],

                    'task1' => [ // Task
                        'type' => 'text', 'placeholder' => 'Задание 1',
                    ],
                    'task1_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task1_we' => [ // with errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено с ошибками',
                    ],
                    'task1_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task2' => [ // Task
                        'type' => 'text', 'placeholder' => 'Задание 2',
                    ],
                    'task2_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task2_we' => [ // with errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено с ошибками',
                    ],
                    'task2_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task3' => [ // Task
                        'type' => 'text', 'placeholder' => 'Задание 3',
                    ],
                    'task3_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task3_we' => [ // with errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено с ошибками',
                    ],
                    'task3_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task4' => [ // Task
                        'type' => 'text', 'placeholder' => 'Задание 4',
                    ],
                    'task4_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task4_we' => [ // with errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено с ошибками',
                    ],
                    'task4_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task5' => [ // Task
                        'type' => 'text', 'placeholder' => 'Задание 5',
                    ],
                    'task5_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task5_we' => [ // with errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено с ошибками',
                    ],
                    'task5_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task6' => [ // Task
                        'type' => 'text', 'placeholder' => 'Задание 6',
                    ],
                    'task6_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task6_we' => [ // with errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено с ошибками',
                    ],
                    'task6_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task7' => [ // Task
                        'type' => 'text', 'placeholder' => 'Задание 7',
                    ],
                    'task7_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task7_we' => [ // with errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено с ошибками',
                    ],
                    'task7_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task8' => [ // Task
                        'type' => 'text', 'placeholder' => 'Задание 8',
                    ],
                    'task8_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task8_we' => [ // with errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено с ошибками',
                    ],
                    'task8_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task9' => [ // Task
                        'type' => 'text', 'placeholder' => 'Задание 9',
                    ],
                    'task9_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task9_we' => [ // with errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено с ошибками',
                    ],
                    'task9_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],

                    'task10' => [ // Task
                        'type' => 'text', 'placeholder' => 'Задание 10',
                    ],
                    'task10_woe' => [ // without errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено правильно',
                    ],
                    'task10_we' => [ // with errors
                        'type' => 'checkbox', 'placeholder' => 'задание выполнено с ошибками',
                    ],
                    'task10_wr' => [ // didn't make a decision
                        'type' => 'checkbox', 'placeholder' => 'не приступил(а) к решению',
                    ],
                ],
            ],
        ],


    ];
}
