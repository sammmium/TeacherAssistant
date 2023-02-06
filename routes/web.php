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

/*
 * /home
 *
 * если в БД уже есть данные об учебном заведении и учителе,
 * редирект /home/group - отображается блок выбора/создания классов (групп) -
 *
 * если в БД еще нет данных об учебном заведении и учителе
 * редирект /settings - кнопки перехода в соответствующие формы
 */
Route::get('/home', 'HomeController@index')->name('home');

/*
 * /home/group
 *
 * отображается список классов (групп) в виде кнопок, если они имеются в БД
 * отображается кнопка добавления класса (группы) - редирект /group
 */

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



Route::get('/group', 'GroupController@index')->name('group');
Route::get('/group/create', 'GroupController@create')->name('group-create');
Route::post('/group/add', 'GroupController@add')->name('group-add');
Route::post('/group/edit', 'GroupController@edit')->name('group-edit');
Route::post('/group/store', 'GroupController@store')->name('group-store');
Route::post('/group/delete', 'GroupController@delete')->name('group-delete');
Route::get('/group/select/{id}', 'GroupController@select')->name('group-select');



Route::get('/test', 'TestController@index')->name('test');
Route::get('/test/card/{id}', 'TestController@card')->name('test-card');
Route::get('/test/download', 'TestController@download')->name('test-download');
Route::post('/test/card/store', 'TestController@store')->name('test-card-store');




Route::get('/home/group/list', 'HomeController@group_list')->name('home-group-list');
Route::get('/home/group/{id}', 'HomeController@group_index')->name('home-group-index');
Route::post('/home/group/list/return', 'HomeController@group_list_return')->name('group-list-return');
Route::get('/home/group/list/add', 'HomeController@group_list_add')->name('home-group-list-add');

Route::get('/home/subject/{id}', 'HomeController@subject_index')->name('home-subject-index');
Route::post('/home/subject/list', 'HomeController@subject_list')->name('home-subject-list');

Route::get('/home/test/{id}', 'HomeController@test_index')->name('home-test-index');
Route::post('/home/test/list', 'HomeController@test_list')->name('home-test-list');
Route::post('/home/test/download', 'HomeController@test_download')->name('home-test-download');

Route::get('/home/card/{id}', 'HomeController@card_index')->name('home-card-index');
Route::post('/home/card/store', 'HomeController@card_store')->name('home-card-store');
Route::post('/home/card/list', 'HomeController@card_list')->name('home-card-list');


Route::get('/home/pupil/{id}', 'HomeController@pupil_index')->name('home-pupil-index');








