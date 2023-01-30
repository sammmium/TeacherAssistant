<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')
    ->name('home');

Route::get('/educational_institution', 'EducationalInstitutionController@index')
    ->name('educational-institution');

Route::get('/educational_institution/create', 'EducationalInstitutionController@create')
    ->name('educational-institution-create');

Route::post('/educational_institution/edit', 'EducationalInstitutionController@edit')
    ->name('educational-institution-edit');

Route::post('/educational_institution/store', 'EducationalInstitutionController@store')
    ->name('educational-institution-store');

Route::post('/educational_institution/add', 'EducationalInstitutionController@add')
    ->name('educational-institution-add');

Route::get('/teacher', 'TeacherController@index')
    ->name('teacher');

Route::get('/teacher/create', 'TeacherController@create')
    ->name('teacher-create');

Route::post('/teacher/edit', 'TeacherController@edit')
    ->name('teacher-edit');

Route::post('/teacher/store', 'TeacherController@store')
    ->name('teacher-store');

Route::post('/teacher/add', 'TeacherController@add')
    ->name('teacher-add');

Route::get('/settings', 'SettingsController@index')
    ->name('settings');
