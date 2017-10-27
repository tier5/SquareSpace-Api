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
    return view('index');
});

Route::get('/index', function () {
    return view('index');
});

Route::post('generate-label', ['uses' => 'LabelController@generateLabel'])->name('generateLabel');

Route::post('print-label', ['uses' => 'LabelController@printLabel'])->name('printLabel');

//Route::get('generate-label', ['uses' => 'LabelController@generateLabel']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
