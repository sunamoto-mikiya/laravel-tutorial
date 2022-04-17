<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

//'/'にアクセスされるとPostControllarのindexメソッドで処理される。
//名前付きルーティング route名home
Route::get('/', 'PostController@index')->name('home');
//resourceコントローラー
//onlyメソッドで使うメソッドを指定できる(指定しないと全てのコントローラーが作成される)
//route(front.posts.index/show)で使える
Route::resource('posts', 'PostController')->only(['index', 'show']);
