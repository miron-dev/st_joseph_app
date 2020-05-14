<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/home', 'HomeController@index')->name('home');

// Route::group(['middleware' => ['auth']], function() {
    // Route::resource('task','TaskController');
    // Route::post('addTask','TaskController@addTask');
    // Route::post('editTask','TaskController@editTask');
    // Route::delete('deleteTask','TaskController@deleteTask');
    // Route::post('approveTask','TaskController@editApprove');

  // });

  Route::middleware(['auth'])->group(function () {
    Route::get('/approval', 'HomeController@approval')->name('approval');

    Route::middleware(['approved'])->group(function () {
        Route::get('/home', 'HomeController@index')->name('home');
        Route::resource('task','TaskController');
        Route::post('addTask','TaskController@addTask');
        Route::post('editTask','TaskController@editTask');
        Route::delete('deleteTask','TaskController@deleteTask');
      });
      
      Route::middleware(['admin'])->group(function () {
        Route::get('/users', 'UserController@index')->name('admin.users.index');
        Route::get('/users/{user_id}/approve', 'UserController@approve')->name('admin.users.approve');
        Route::post('approveTask','TaskController@editApprove');
    });
});
