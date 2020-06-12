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

Route::group(['middleware' => ['guest']], function () {
  Route::get('/', function () {
    return view('auth/login');
  });
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
    // Route::get('users/{user}/edit','UserController@edit');
    
    Route::middleware(['approved'])->group(function () {
      Route::get('/home', 'HomeController@index')->name('home');
      Route::resource('task','TaskController');
      Route::post('addTask','TaskController@addTask');
      Route::post('editTask','TaskController@editTask');
      Route::delete('deleteTask','TaskController@deleteTask');
      Route::resource('users','UserController')->except(['create'])->middleware('user');// A modifier pour les acces selon les types
      Route::get('upload', 'ImageController@index');
      Route::post('upload', 'ImageController@upload')->name('upload');
      Route::post('taskDone','TaskController@taskDone');      
      });

      Route::middleware(['admin'])->group(function () {
        Route::get('/approve', 'UserController@indexAdmin')->name('admin.users.indexAdmin');
        Route::get('/users/{user_id}/approve', 'UserController@approve')->name('admin.users.approve');
        Route::post('approveTask','TaskController@editApprove');
        Route::get('users/create','UserController@create')->name('users.create');
        Route::get('users','UserController@index')->name('users.index');
        Route::delete('users/{user}','UserController@destroy')->name('users.destroy');
        Route::post('taskDoneAdmin','TaskController@taskDoneAdmin');
        Route::post('editPriority','TaskController@editPriority');
        Route::get('indexTasksDones','TaskController@indexTasksDones');
    });
});
