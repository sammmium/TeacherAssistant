<?php

return [
    /*
     * Buttons
     */
    'buttons' => [
        'login' => 'Login',
        'register' => 'Register',
        'logout' => 'Logout',
        'home' => 'Homepage',
        'tests' => 'Tests',
        'settings' => 'Settings',
        'save' => 'Save',
        'add' => 'Add',
        'delete' => 'Delete',
        'back' => 'Back',
    ],
    'pages' => [

        /*
         * Login page
         */
        'login' => [
            'title' => 'Login Page',
            'email' => 'E-Mail Address',
            'password' => 'Password',
            'remember_me' => 'Remember Me',
            'forgot_password' => 'Forgot Your Password?',
            'submit' => 'Enter'
        ],

        /*
         * Register page
         */
        'register' => [
            'title' => 'Register',
            'name' => 'Name',
            'email' => 'E-Mail Address',
            'password' => 'Password',
            'confirm_password' => 'Confirm Password',
            'submit' => 'Register'
        ],

        /*
         * Home page
         */
        'home' => [],

        /*
         * Tests page
         */
        'tests' => [],

        /*
         * Settings page
         */
        'settings' => [
            'title' => 'Settings',
            'info' => 'These instances must be filled. First of all must be filled Teacher.',
            'teacher' => 'Teacher',
            'educational_institution' => 'Educational Institution'
        ],


        'educational_institution' => [
            'title' => [
                'index' => 'Settings: Educational Institution',
                'edit' => 'Settings: Educational Institution (Edit)',
                'create' => 'Settings: Educational Institution (Create)',
            ],
            'full_name' => 'Full Name',
            'short_name' => 'Short Name',
            'address' => 'Address',
            'submit' => 'Save',
            'edit' => 'Edit',
        ],

        'teacher' => [
            'title' => [
                'index' => 'Settings: Teacher',
                'edit' => 'Settings: Teacher (Edit)',
                'create' => 'Settings: Teacher (Create)',
            ],
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'job_title' => 'Job Title',
            'submit' => 'Save',
            'edit' => 'Edit',
        ],
    ],

];
