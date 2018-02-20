<?php
use App\User;
use Carbon\Carbon;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::any('test', function() {
   $user =  User::find(90);
    $times = User::timesInOffice();
    return $times;
});


Route::get('/', function () { return redirect('login'); });
Route::get('logout', 'Auth\LoginController@logout');

Route::group(['prefix' => 'import'], function () {
    Route::any('users', 'ImportController@users');
    Route::any('records', 'ImportController@records');
});

Route::group(['prefix' => 'leaves'], function () {
    Route::get('/', 'LeavesController@index');
    Route::get('create', 'LeavesController@create');
    Route::post('/', 'LeavesController@store')->middleware('csrf');
    Route::get('{leave}/edit', 'LeavesController@edit');
    Route::post('{leave}', 'LeavesController@update')->middleware('csrf');
    Route::delete('{leave}', 'LeavesController@destroy')->name('leaves.delete')->middleware('csrf');
});

Route::group(['prefix' => 'employee'], function() {
    Route::get('edit', 'UsersController@edit');
    Route::patch('update', 'UsersController@update')->middleware('csrf');
    Route::delete('clear_avatar', 'UsersController@clear_avatar')->middleware('csrf');
    Route::get('{user}/attendance', 'UsersController@show');
});

Route::group(['middleware' => 'admin', 'namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::get('/', 'ReportsController@index');
    Route::get('leaves', 'LeavesController@index');
    Route::get('leaves/{type?}', 'LeavesController@index')->where('type', '^(approved|declined|pending)$');
    Route::get('leaves/{leave}/{action}', 'LeavesController@manage')->where('action', '^(approve|decline)$');
    Route::get('employees', 'UsersController@index');
    Route::get('employees/{user}/edit', 'UsersController@edit');
    Route::patch('employees/{user}', 'UsersController@update');
});
