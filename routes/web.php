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
Route::group(['middleware' => 'forcehttps'], function () {

Route::get('/', function () {
    return view('index');
});

Route::get('/index', function () {
    return view('index');
});

Route::post('get-label', ['uses' => 'LabelController@getLabel', 'https' => true])->name('getLabel');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
});