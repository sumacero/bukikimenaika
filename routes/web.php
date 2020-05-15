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

Route::get('/login/', function () {
    return 'login';
});

Route::get('/create_account/', function () {
    return 'create_account';
});

Route::get('/home/', function () {
    return 'home';
});

Route::get('/input_data/', function () {
    return 'input_data';
});

Route::get('/view_data/', function () {
    return 'view_data';
});

Route::get('/search_buki/', function () {
    return 'search_buki';
});

