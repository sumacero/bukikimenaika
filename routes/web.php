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

Route::get('login','MainController@login');

Route::get('create_account','MainController@create_account');

Route::get('home','MainController@home');

Route::get('input_data','MainController@input_data');

Route::post('input_data','MainController@input_data_complete');

Route::get('edit_data','MainController@edit_data');

Route::post('insert_data','MainController@insert_data');

Route::post('update_data','MainController@update_data');

Route::get('view_data','MainController@view_data');

Route::get('search_buki','MainController@search_buki');

Route::post('search_buki','MainController@analysis_buki');

