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

Route::get('/test', function() {
    return view('testPage');
});

Route::get('list', 'InstructorsController@list');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/testPage');

//students routes
Route::get('/students',                   'StudentsController@list');
Route::get('/students/create',            'StudentsController@create');
Route::post('/students',                  'StudentsController@store');
Route::get('/students/{student}',         'StudentsController@show');
Route::get('/students/delete/{student}',  'StudentsController@delete');

