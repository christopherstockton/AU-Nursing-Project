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
Route::get('/clinicals',                 'ClinicalController@listClinicals')->middleware('auth');
Route::get('/sites',                  'SitesController@listSites');

//Sites Routes
Route::get('/sites/create',             'SitesController@create');
Route::post('/sites',                   'SitesController@store');
Route::get('/sites/{ID}',               'SitesController@show');
Route::get('/sites/delete/{ID}',        'SitesController@delete');
Route::get('/sites/{ID}/edit',          'SitesController@edit');
Route::put('/sites/{ID}',               'SitesController@update');


//People Routes
Route::get('/people/create',             'PeopleController@create')->middleware('auth');
Route::post('/people',                   'PeopleController@store')->middleware('auth');
Route::get('/people/{ID}',               'PeopleController@show')->middleware('auth');
Route::get('/people/delete/{ID}',        'PeopleController@delete')->middleware('auth');
Route::get('/people/{ID}/edit',          'PeopleController@edit')->middleware('auth');
Route::put('/people/{ID}',               'PeopleController@update')->middleware('auth');

//Clinicals Routes
Route::get('/clinicals/create',          'ClinicalController@create')->middleware('auth');
Route::post('/clinicals',                'ClinicalController@store')->middleware('auth');
Route::get('/clinicals/{ID}',            'ClinicalController@show')->middleware('auth');
Route::get('/clinicals/delete/{ID}',     'ClinicalController@delete')->middleware('auth');
Route::get('/clinicals/{ID}/edit',       'ClinicalController@edit')->middleware('auth');
Route::put('/clinicals/{ID}',            'ClinicalController@update')->middleware('auth');