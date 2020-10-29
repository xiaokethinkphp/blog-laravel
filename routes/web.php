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
Route::get('user/{user}/article', 'ArticleController@lst')->middleware('auth')->name('article.lst');
// 修改文章界面
Route::get('user/{user}/article/{article}/edit', 'ArticleController@edit')->middleware('auth')->name('article.edit');
Route::put('user/{user}/article/{article}', 'ArticleController@update')->middleware('auth')->name('article.update');
Route::delete('user/{user}/article/{article}', 'ArticleController@destroy')->middleware('auth')->name('article.destroy');
Route::get('article/{article}', 'ArticleController@show')->name('article.show');

Route::get('admin/index', function() {
    return view('admin.index');
});
Route::get('admin/welcome', function() {
    return view('admin.welcome');
});
/*后台用户路由*/
Route::name('admin.users.')->namespace('Admin')->prefix('admin/users')->group(function () {
    // 用户列表
    Route::get('/', function() {
        return view('admin.users');
    });
    // 获取用户信息
    Route::get('/info', 'UserController@info')->name('info');
    // 添加用户列表
    Route::get('/create', function() {
        return view('admin.createUser');
    })->name('create');
    // 添加用户提交
    Route::post('/', 'UserController@store')->name('store');
    Route::get('/{user}/edit', 'UserController@edit')->name('edit');
    Route::put('/{user}', 'UserController@update')->name('update');
    Route::get('/{user}/restore', 'UserController@restore')->name('restore');
    Route::delete('/{user}', 'UserController@destroy')->name('destroy');
});
