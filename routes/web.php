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

Route::get('search_buki','MainController@search_buki');
Route::post('search_buki','MainController@analysis_buki');

Route::get('edit_data','MainController@edit_data');
Route::get('get_parent_tables','AjaxController@getParentTables');
Route::get('get_input_datas','AjaxController@getInputDatas');
Route::post('insert_record','AjaxController@insertRecord');
Route::post('delete_record','AjaxController@deleteRecord');
Route::post('update_record','AjaxController@updateRecord');
Route::get('get_stage_info','AjaxController@getStageInfo');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
