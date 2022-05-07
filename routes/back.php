<?php

use App\Http\Controllers\Back\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', 'DashboardController')->name('dashboard');
// Route::resource('posts', 'PostController');
Route::resource('user', 'UserController');
// Route::get('posts/person/', 'PostController@person')->name('personPost');
Route::resource('tasks', 'TaskController');
Route::put('tasks/status/{task}', 'TaskController@status')->name('status');
