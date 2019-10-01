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
    return view('welcome'); //welcome.blade.phpで定義されたCSSなどを取得
});
Route::resource('todo', 'TodoController'); //処理実行時の参照ファイルを定義。todoController.phpをtodoと命名し、「todo.メソッド名」でメソッド呼び出し可能にする。

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
