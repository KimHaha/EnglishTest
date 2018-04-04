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

Route::get('users', 'UserController@index')->name('list_user');

Route::get('class', 'ClassController@index')->name('class');

Route::get('roles/{id}/permissions', 'RoleController@edit_permission')->name('roles.edit_permission');
Route::get('roles/{id}/permissions/{id_permission}/delete', 'RoleController@delete_permission')->name('roles.delete_permission');

Route::resources([
    'roles' => 'RoleController',
    'permissions' => 'PermissionController',
    'questions' => 'QuestionController',
    'users' => 'UserController',
]);

Route::get('test/{id}', 'RoleController@show');

Route::get('hand', function () {
    $role = App\Role::find(1);

    $permission = App\Permission::find(1);

    $role->attachPermission($permission);
    echo 'yes';
});