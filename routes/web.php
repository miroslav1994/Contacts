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

use App\Models\Contact;

Route::get('/', function () {
    $contacts = Contact::orderBy('id')->paginate(10);
    return view('frontend.index')->with('contacts', $contacts);;
});

Route::get('/administration', function () {
    if(Auth::check()) {
        return redirect('/home');
    }
  return view('auth.login');
});

Route::group(['middleware' => ['auth']], function() {
    Route::resource('/administration/roles', 'RolesController');
    Route::resource('/administration/users', 'UsersController');
    Route::resource('/administration/contacts', 'ContactsController');
    Route::post('/administration/postajaxContacts', 'ContactsController@store');
});

Auth::routes();
Route::get('/logout', 'LoginController@logout');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


