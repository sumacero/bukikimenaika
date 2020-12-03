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
/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('search_buki','MainController@search_buki')->middleware('verified');
Route::post('search_buki','MainController@analysis_buki')->middleware('verified');
Route::get('edit_data','MainController@edit_data')->middleware('verified');
Route::get('view_gachi','MainController@view_gachi')->middleware('verified');
Route::get('get_parent_tables','AjaxController@getParentTables');
Route::get('get_input_datas','AjaxController@getInputDatas');
Route::get('get_gachis','AjaxController@getGachis');
Route::post('insert_record','AjaxController@insertRecord');
Route::post('delete_record','AjaxController@deleteRecord');
Route::post('update_record','AjaxController@updateRecord');
Route::get('get_stage_info','AjaxController@getStageInfo');
Route::get('/hello','HelloController@index');
Auth::routes(['verify' => true]);
Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::get('/verified', function(){
    return view('verified');
})->middleware('verified');