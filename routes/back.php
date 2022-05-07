<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'DashboardController')->name('dashboard');
// Route::resource('posts', 'PostController');
Route::resource('user', 'UserController');
// Route::get('posts/person/', 'PostController@person')->name('personPost');
Route::resource('tasks', 'TaskController');
