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
Route::get('dd', 'HomeController@hd')->middleware('verified');;

Auth::routes(['verify' => true]);


Route::get('article/create', 'ArticleController@create')->middleware('auth')->name('article.create');
