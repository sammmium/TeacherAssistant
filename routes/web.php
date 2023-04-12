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

Route::get('/dicts', 'DictsController@index')->name('dicts');
Route::get('/dict/{id}', 'DictsController@select')->name('dicts-select');
Route::post('/dict/add', 'DictsController@add')->name('dict-add');
Route::post('/dict/store', 'DictsController@store')->name('dict-store');
Route::get('/dict/edit/{id}', 'DictsController@edit')->name('dict-edit');
Route::post('/dict/update', 'DictsController@update')->name('dict-update');
Route::post('/dict/delete', 'DictsController@delete')->name('dict-delete');

Route::get('/teacher', 'TeacherController@index')->name('teacher');
Route::get('/teacher/create', 'TeacherController@create')->name('teacher-create');
Route::post('/teacher/edit', 'TeacherController@edit')->name('teacher-edit');
Route::post('/teacher/store', 'TeacherController@store')->name('teacher-store');
Route::post('/teacher/add', 'TeacherController@add')->name('teacher-add');

Route::get('/educational_institution', 'EducationalInstitutionController@index')->name('educational-institution');
Route::post('/educational_institution/add', 'EducationalInstitutionController@add')->name('educational-institution-add');
Route::post('/educational_institution/select', 'EducationalInstitutionController@select')->name('educational-institution-select');
Route::post('/educational_institution/selected', 'EducationalInstitutionController@selected')->name('educational-institution-selected');
Route::get('/educational_institution/edit/{id}', 'EducationalInstitutionController@edit')->name('educational-institution-edit');
Route::get('/educational_institution/reset/{id}', 'EducationalInstitutionController@reset')->name('educational-institution-reset');
Route::get('/educational_institution/create', 'EducationalInstitutionController@create')->name('educational-institution-create');
Route::post('/educational_institution/store', 'EducationalInstitutionController@store')->name('educational-institution-store');

// форма отображения списка выбранных классов
Route::get('/home/groups', 'UnitsGroupsController@index')->name('home-groups-index');

// форма выбора и добавления класса к списку выбранных
Route::get('/home/group/add', 'UnitsGroupsController@group_add')->name('home-group-add');

// отправка данных о выбранном классе
Route::get('/home/group/select/{id}', 'UnitsGroupsController@select')->name('home-group-select');


Route::post('/home/group/selected', 'UnitsGroupsController@selected')->name('home-group-selected');
Route::get('/home/group/reset/{id}', 'UnitsGroupsController@group_reset')->name('home-group-reset');
Route::get('/dict/group/create', 'DictsController@group_create')->name('dict-group-create');
Route::get('/home/group/{id}', 'HomeController@group_index')->name('home-group-index');
Route::post('/home/group/list/return', 'HomeController@group_list_return')->name('group-list-return');

//Route::get('/home/subjects', 'UnitsSubjectsController@index')->name('home-subjects-index');
Route::post('/home/subject/reset', 'UnitsSubjectsController@subject_reset')->name('home-subject-reset');

// переход к форме выбора предмета для добавления предмета к списку выбранных
Route::get('/home/subject/add', 'UnitsSubjectsController@subject_add')->name('home-subject-add');

Route::post('/home/subject/selected', 'UnitsSubjectsController@selected')->name('home-subject-selected');

Route::get('/home/subject/create', 'DictsController@subject_create')->name('dict-subject-create');

Route::post('/home/subject/list', 'HomeController@subject_list')->name('home-subject-list');

//
Route::get('/home/subject/{id}', 'HomeController@subject_index')->name('home-subject-index');

// Переход к форме добавления КР в список выбранных КР
Route::get('/home/test/add', 'TestsController@add')->name('home-test-add');
Route::post('/home/test/add/theme', 'TestsController@add_theme')->name('home-test-add-theme');

Route::post('/home/test/show/selected/form', 'TestsController@show_selected_form')->name('home-test-show-selected-form');

// Сохранение новой контрольной работы
// с последующим перенаправлением на home
Route::post('/home/test/create', 'TestsController@create')->name('home-test-create');

Route::get('/home/test/select/{id}', 'TestsController@select')->name('home-test-select');
Route::post('/home/test/reset', 'TestsController@reset')->name('home-test-reset');

Route::get('/home/test/{id}', 'HomeController@test_index')->name('home-test-index');


Route::post('/home/test/list', 'HomeController@test_list')->name('home-test-list');
Route::post('/home/test/form/store', 'TestsController@form_store')->name('test-form-store');

// переход к форме наполнения списка учеников для выбранного класса
Route::get('/home/group/{id}/fill', 'UnitsGroupsController@group_fill')->name('group-pupil-add');
Route::get('/home/group/pupil/{id}/edit', 'UnitsGroupsController@group_pupil_edit')->name('group-pupil-edit');
Route::get('/home/group/{id}/pupil/create', 'UnitsGroupsController@group_pupil_create')->name('group-pupil-create');
Route::post('/home/group/pupil/store', 'UnitsGroupsController@group_pupil_store')->name('group-pupil-store');
Route::post('/home/group/pupil/delete', 'UnitsGroupsController@group_pupil_delete')->name('group-pupil-delete');

Route::post('/home/member/add', 'HomeController@add_member')->name('add_member');
Route::post('/home/member/reset', 'HomeController@reset_member')->name('reset_member');

Route::get('/settings', 'SettingsController@index')->name('settings');

Route::get('/ugp/{id}/card/index', 'CardsController@index')->name('card-index');
Route::post('/ugp/{id}/card/store', 'CardsController@store')->name('card-store');

// список учеников
Route::post('/home/card/list', 'HomeController@card_list')->name('home-card-list');



Route::post('/home/test/download', 'TestsController@download')->name('home-test-download');







//
//
//
//Route::get('/group', 'GroupController@index')->name('group');
//Route::get('/group/create', 'GroupController@create')->name('group-create');
//Route::post('/group/add', 'GroupController@add')->name('group-add');
//Route::post('/group/edit', 'GroupController@edit')->name('group-edit');
//Route::post('/group/store', 'GroupController@store')->name('group-store');
//Route::post('/group/delete', 'GroupController@delete')->name('group-delete');
//Route::get('/group/select/{id}', 'GroupController@select')->name('group-select');
//
//
//
//Route::get('/test', 'TestController@index')->name('test');
//Route::get('/test/card/{id}', 'TestController@card')->name('test-card');
//Route::get('/test/download', 'TestController@download')->name('test-download');
//Route::post('/test/card/store', 'TestController@store')->name('test-card-store');
//
//
//
//
////Route::get('/home/group/list', 'HomeController@group_list')->name('home-group-list');
////
////
////
//
////Route::get('/home/subject/{id}', 'HomeController@subject_index')->name('home-subject-index');
//
//
//
//Route::post('/home/test/list', 'HomeController@test_list')->name('home-test-list');
//
//
//Route::get('/home/card/{id}', 'HomeController@card_index')->name('home-card-index');
//Route::post('/home/card/store', 'HomeController@card_store')->name('home-card-store');
//
//
//Route::get('/home/pupil/{id}', 'HomeController@pupil_index')->name('home-pupil-index');








