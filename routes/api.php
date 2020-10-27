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
Route::name('api.admin.')->namespace('Admin')->prefix('admin/users')->group(function () {
    // 用户列表
    Route::get('/', function() {
        return view('admin.users');
    });
    // 获取用户信息
    Route::get('/info', 'UserController@info')->name('users.info');
    // 添加用户列表
    Route::get('/create', function() {
        return view('admin.createUser');
    })->name('users.create');
    // 添加用户提交
    Route::post('/', 'UserController@store')->name('users.store');
});
