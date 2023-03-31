<?php

namespace App\Http\Models\Tests;

class MathTypeTestList implements TestTypeInterface
{
    private $typeList = [
        // 1 класс
        1 => [
            'math_kr' => [
                'name' => 'Контрольная работа',
                'tasks' => [
                    'calculation', // Вычисления
                    'number_series', // Числовой ряд
                    'comparison', // Сравнение
                    'exercise', // Задача
                    'geometric_exercise', // Геометрическая задача
                    'unknown_component', // Нахождение неизвестной компоненты
                    'writing_numbers', // Написание цифр
                ],
                'errors' => [
                    'calculation' => [
                        'woe', // задание выполнено правильно
                        '', // a + b
                    ],
                    'number_series', // Числовой ряд
                    'comparison', // Сравнение
                    'exercise', // Задача
                    'geometric_exercise', // Геометрическая задача
                    'unknown_component', // Нахождение неизвестной компоненты
                    'writing_numbers', // Написание цифр
                ]
            ],
            'math_kus' => [
                'name' => 'Контрольный устный счет',
                'tasks' => [
                    'math_kus_1_t1',
                    'math_kus_1_t2',
                    'math_kus_1_t3',
                    'math_kus_1_t4',
                    'math_kus_1_t5',
                    'math_kus_1_t6',
                    'math_kus_1_t7',
                    'math_kus_1_t8',
                    'math_kus_1_t9',
                    'math_kus_1_t10',
                ]
            ]
        ],

        // 2 класс
        2 => [
            'math_kr' => 'Контрольная работа',
            'math_kus' => 'Контрольный устный счет'
        ],

        // 3 класс
        3 => [
            'math_kr' => 'Контрольная работа',
            'math_kus' => 'Контрольный устный счет'
        ],

        // 4 класс
        4 => [
            'math_kr' => 'Контрольная работа',
            'math_kus' => 'Контрольный устный счет'
        ],

    ];

    private $group;

    private $key;

    public function __construct(int $group, string $key = null)
    {
        $this->group = $group;
        $this->key = $key;
    }

    public function getTypeList(): array
    {
        return $this->typeList[$this->group];
    }

    public function getTypeName(): string
    {
        if (is_null($this->key)) {
            return '';
        }

        return $this->typeList[$this->group][$this->key];
    }
}
