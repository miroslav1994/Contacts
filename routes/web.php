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
  return view('auth.login');
});

Route::resource('roles', 'RolesController');

Route::resource('companies', 'CompaniesController');
Route::resource('users', 'UsersController');
Route::resource('users_type', 'UsersTypeController');
Route::resource('tasks_type', 'TasksTypeController');
Route::resource('model_create_tasks', 'ModelCreateTasksController');

Route::resource('responsible_users', 'ResponsibleUsersController');
Route::resource('applications', 'ApplicationsController');
Route::get('tasks/popular', 'TasksController@storeTaskItem');
Route::get('tasks/sidebar', 'TasksController@storeSideBarContent');
Route::get('tasks/odobri', 'TasksController@odobri');
Route::resource('tasks', 'TasksController');
Route::resource('tasks_persons_involved', 'TasksPersonsInvolvedController');
Route::resource('tasks_tasks_type', 'TasksTasksTypeController');
Route::resource('tasks_items', 'TasksItemsController');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
