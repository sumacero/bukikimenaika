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
Route::get('/', 'MainController@view_gachi')->name('home')->middleware('verified');
Route::get('email_reset','MainController@emailReset')->middleware('verified');
Route::get("reset/{token}", "ChangeEmailController@reset");
Route::post('email', 'ChangeEmailController@sendChangeEmailLink');
Route::get('email_changed', 'MainController@emailChanged')->middleware('verified');
Route::get('view_gachi','MainController@view_gachi')->middleware('verified');
Route::get('get_parent_tables','AjaxController@getParentTables');
Route::get('get_input_datas','AjaxController@getInputDatas');
Route::get('get_gachis','AjaxController@getGachis');
Route::post('insert_record','AjaxController@insertRecord');
Route::post('delete_record','AjaxController@deleteRecord');
Route::post('update_record','AjaxController@updateRecord');
Route::get('get_stage_info','AjaxController@getStageInfo');
Route::get('get_osusume_bukis','AjaxController@getOsusumeBukis');
Route::get('about', 'MainController@about');

Auth::routes(['verify' => true]);
Route::get('/main', 'MainController@index')->name('main')->middleware('verified');
Route::get('/verified', function(){
    return view('verified');
})->middleware('verified');