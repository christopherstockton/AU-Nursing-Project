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
    return view('auth/login');
});

Auth::routes();

Route::get('/welcome', function () {
    return view('/welcome');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/students',                  'PeopleController@listStudents')->middleware('auth');
Route::get('/instructors',               'PeopleController@listInstructors')->middleware('auth');
Route::get('/labs',                      'ClinicalController@listLabs')->middleware('auth');
Route::get('/clinicals',                 'ClinicalController@listClinicals')->middleware('auth');

Route::get('/people/create',             'PeopleController@create')->middleware('auth');
Route::post('/people',                   'PeopleController@store')->middleware('auth');
Route::get('/people/{ID}',               'PeopleController@show')->middleware('auth');
Route::get('/people/delete/{ID}',        'PeopleController@delete')->middleware('auth');
Route::get('/people/{ID}/edit',          'PeopleController@edit')->middleware('auth');
Route::put('/people/{ID}',               'PeopleController@update')->middleware('auth');

Route::get('/clinicals/create',          'ClinicalController@create')->middleware('auth');
Route::post('/clinicals',                'ClinicalController@store')->middleware('auth');
Route::get('/clinicals/{ID}',            'ClinicalController@show')->middleware('auth');
Route::get('/clinicals/delete/{ID}',     'ClinicalController@delete')->middleware('auth');
Route::get('/clinicals/{ID}/edit',       'ClinicalController@edit')->middleware('auth');
Route::put('/clinicals/{ID}',            'ClinicalController@update')->middleware('auth');