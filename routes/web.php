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
    return view('index');
})->name('main_page');

Auth::routes();

Route::group(['middleware' => ['auth', 'web']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('roles/{role_id}/users', 'RoleController@list_user')->name('role_list_user');

	Route::resource('roles/{role_id}/permissions', 'RolePermissionController', [
		'as' => 'roles', 'only' => ['index', 'destroy']
	]);

	Route::get('examinations/{id}/create_exam', 'ExaminationController@createExam')
		->name('generate_list_exam');

	Route::get('classes/{id}/add_user', 'ClassController@add_user')
		->name('classes.users.add');
	Route::post('classes/{id}/add_user', 'ClassController@store_user')
		->name('classes.users.store');

	Route::get('generate_list_exam/{examination_id}/{num}', 'ExamController@generateListExam');

	Route::get('classes/{id}/remove_user/{user_id}', 'ClassController@remove_user')
		->name('classes.users.destroy');

	Route::get('do_contest', 'ExaminationController@do_contest')
		->name('do_contest');

	Route::get('do_examination/{id}', 'ExaminationController@do_examination')
		->name('do_examination');

	Route::post('result/{test_id}', 'ExamController@calculate_score')
		->name('calculate_score');

	Route::get('result/{test_id}', 'ExamController@show_result')
		->name('show_result');

	Route::post('results/search', 'ResultController@search')
		->name('result_search');

	Route::resources([
		'roles'        => 'RoleController',
		'permissions'  => 'PermissionController',
		'questions'    => 'QuestionController',
		'users'        => 'UserController',
		'categories'   => 'CategoryController',
		'examinations' => 'ExaminationController',
		'exams'        => 'ExamController',
		'classes' 		=> 'ClassController',
		'results'		=> 'ResultController',
	]);
});
