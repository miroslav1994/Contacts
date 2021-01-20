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
Route::resource('users', 'UsersController');
Route::resource('phone_types', 'PhoneTypesController');
Route::resource('contacts', 'ContactsController');
Route::post('postajaxContacts', 'ContactsController@store');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
