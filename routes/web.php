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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['namespace'=>'admin'],function() {
    //登录界面
    Route::get('/login','LoginController@login');

    //获取公钥
    Route::get('/getPublicKey','LoginController@getPublicKey');

    //登录动作
    Route::post('/sign','LoginController@sign');

    Route::get('/admin/index','IndexController@index');
});


