<?php

return [
    /*
     * Buttons
     */
    'buttons' => [
        'login' => 'Вход',
        'register' => 'Регистрация',
        'logout' => 'Выход',
        'home' => 'Главная страница',
        'tests' => 'Контрольные работы',
        'settings' => 'Настройки',
        'save' => 'Сохранить',
        'add' => 'Добавить',
        'delete' => 'Удалить',
        'back' => 'Вернуться',
        'edit' => 'Редактировать',
        'test' => 'Тест',
    ],

    'confirm' => [
        'are_you_sure' => 'Вы уверены?'
    ],

    'pages' => [

        /*
         * Login page
         */
        'login' => [
            'title' => 'Страница входа',
            'email' => 'Электронная почта',
            'password' => 'Пароль',
            'remember_me' => 'Запомнить меня',
            'forgot_password' => 'Восстановить пароль',
            'submit' => 'Войти'
        ],

        /*
         * Register page
         */
        'register' => [
            'title' => 'Страница регистрации',
            'name' => 'Имя',
            'email' => 'Электронная почта',
            'password' => 'Пароль',
            'confirm_password' => 'Подтвердить пароль',
            'submit' => 'Зарегистрироваться'
        ],

        /*
         * Home page
         */
        'home' => [
            'main' => [
                'title' => 'Главная страница'
            ],

            'cards' => [
                'groups' => [
                    'title' => 'Список классов',
                    'add_button' => 'Добавить класс'
                ],

                'tests' => [
                    'title' => 'Список контрольных работ',
                    'add_button' => 'Добавить контрольную работу'
                ]
            ],

            'group' => [
                'add' => [
                    'main' => [
                        'title' => 'Главная страница',
                        'educational_institution' => 'Наименование учреждения'
                    ],
                    'new_group' => [
                        'title' => 'Добавить группу (класс)'
                    ]

                ]
            ]
        ],

        /*
         * Tests page
         */
        'tests' => [],

        /*
         * Settings page
         */
        'settings' => [
            'require' => [
                'title' => 'Обязательные настройки',
                'info' => 'Следующие объекты должны быть заполнены. Прежде всего необходимо заполнить Учителя.'
            ],
            'option' => [
                'title' => 'Второстепенные настройки',
                'info' => 'Следующие объекты должны быть заполнены во вторую очередь.'
            ],
            'teacher' => 'Учитель',
            'educational_institution' => 'Учреждение образования',
            'group' => 'Список классов',
        ],


        'educational_institution' => [
            'title' => [
                'index' => 'Настройки: Учебное заведение',
                'edit' => 'Настройки: Учебное заведение (Редактирование)',
                'create' => 'Настройки: Учебное заведение (Создание)',
            ],
            'full_name' => 'Полное наименование',
            'short_name' => 'Краткое наименование',
            'address' => 'Адрес',
            'submit' => 'Сохранить',
            'edit' => 'Редактировать',
        ],

        'teacher' => [
            'title' =>  [
                'index' => 'Настройки: Учитель',
                'edit' => 'Настройки: Учитель (Редактирование)',
                'create' => 'Настройки: Учитель (Создание)',
            ],
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'job_title' => 'Наименование должности',
            'submit' => 'Сохранить',
            'edit' => 'Редактировать',
        ],

        'group' => [
            'title' => [
                'index' => 'Настройки: Список классов',
                'edit' => 'Настройки: Класс (Редактирование)',
                'create' => 'Настройки: Класс (Создание)',
            ],
            'name' => 'Наименование',
            'submit' => 'Сохранить',
            'add_pupil_button' => 'Добавить ученика',
            'edit' => 'Редактировать',
        ],

        'test' => [
            'title' => [
                'index' => 'Главная страница'
            ],
            'name' => 'Тест',
        ]
    ],

];
