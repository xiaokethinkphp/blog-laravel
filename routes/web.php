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

Route::get('/', 'HomeController@index');

Route::get('index', 'HomeController@index')->name('index');
Route::get('dd', 'HomeController@hd')->middleware('verified');
Route::get('imgs', 'HomeController@img');

Auth::routes(['verify' => true]);

/* 文章 */
Route::get('article/create', 'ArticleController@create')->middleware('auth')->name('article.create');
Route::post('article', 'ArticleController@store')->middleware('auth')->name('article.store');
Route::post('article/upload', 'ArticleController@upload')->name('article.upload');
Route::get('user/{user_id}/article', 'ArticleController@lst')->middleware('auth')->name('article.lst');
// 修改文章界面
Route::get('user/{user_id}/article/{id}/edit', 'ArticleController@edit')->middleware('auth')->name('article.edit');
Route::get('user/{user_id}/article/{id}', 'ArticleController@destroy')->middleware('auth')->name('article.destroy');
