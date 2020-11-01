<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('admin/checkLogin', 'Admin\AdminController@checkLogin')->name('admin.admin.checkLogin');

Route::name('api.admin.users.')->namespace('Admin')->prefix('admin/users')->middleware('auth:api')->group(function () {
    // 获取用户信息
    Route::get('/info', 'UserController@info')->name('info');
    // 添加用户提交
    Route::post('/', 'UserController@store')->name('store');
    Route::put('/{user}', 'UserController@update')->name('update');
    Route::get('/{user}/restore', 'UserController@restore')->name('restore');
    Route::delete('/{user}', 'UserController@destroy')->name('destroy');
    Route::post('/deletes', 'UserController@deletes')->name('deletes');
});
