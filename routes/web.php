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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('class', 'ClassController@index')->name('class');

Route::resource('roles/{role_id}/permissions', 'RolePermissionController', [
	'as' => 'roles', 'only' => ['index', 'destroy']
]);

Route::resources([
	'roles'                       => 'RoleController',
	'permissions'                 => 'PermissionController',
	'questions'                   => 'QuestionController',
	'users'                       => 'UserController',
	'categories'				  => 'CategoryController',
]);

Route::get('test/{id}', 'RoleController@show');

Route::get('hand', function () {
    $role = App\Role::find(1);

    $permission = App\Permission::find(1);

    $role->attachPermission($permission);
    echo 'yes';
});