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

Route::get('/', 'ProductController@index');

Route::group(['middleware' => 'auth'], function() {
    Route::post('/', 'ProductController@create');
    Route::get('/mypage', 'MypageController@index');
    Route::post('/mypage', 'MypageController@update');
    Route::post('/mypage_delete', 'MypageController@delete');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
