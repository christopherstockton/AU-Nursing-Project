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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/students',                  'PeopleController@listStudents');
Route::get('/instructors',               'PeopleController@listInstructors');

Route::get('/people/create',             'PeopleController@create');
Route::post('/people',                   'PeopleController@store');
Route::get('/people/{ID}',               'PeopleController@show');
Route::get('/people/delete/{ID}',        'PeopleController@delete');
Route::get('/people/{ID}/edit',          'PeopleController@edit');
Route::put('/people/{ID}',               'PeopleController@update');

Route::get('/clinicals/create',             'ClinicalController@create');
Route::post('/clinicals',                   'ClinicalController@store');
Route::get('/clinicals/{ID}',               'ClinicalController@show');
Route::get('/clinicals/delete/{ID}',        'ClinicalController@delete');
Route::get('/clinicals/{ID}/edit',          'ClinicalController@edit');
Route::put('/clinicals/{ID}',               'ClinicalController@update');
