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

Route::get('registers', function() {
    return view('/auth/register');
});

Route::post('/reg', 'CreateUser@createUser')->middleware('auth');

Route::get('/help', function() {
    return view('/help');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/students',                  'PeopleController@listStudents')->middleware('auth');
Route::get('/instructors',               'PeopleController@listInstructors')->middleware('auth');
Route::get('/labs',                      'ClinicalController@listLabs')->middleware('auth');
Route::get('/clinicals',                 'ClinicalController@listClinicals')->middleware('auth');
Route::get('/sites',                  'SitesController@listSites')->middleware('auth');
Route::get('/courses',                   'CoursesController@listCourses')->middleware('auth');
Route::get('/schedule',                   'ScheduleController@listSchedule')->middleware('auth');
Route::get('/settings',                 'SettingsController@listSettings')->middleware('auth');

//Sites Routes
Route::get('/sites/create',             'SitesController@create')->middleware('auth');
Route::post('/sites',                   'SitesController@store')->middleware('auth');
Route::get('/sites/{ID}',               'SitesController@show')->middleware('auth');
Route::get('/sites/delete/{ID}',        'SitesController@delete')->middleware('auth');
Route::get('/sites/{ID}/edit',          'SitesController@edit')->middleware('auth');
Route::put('/sites/{ID}',               'SitesController@update')->middleware('auth');


//People Routes
Route::get('/people/create',             'PeopleController@create')->middleware('auth');
Route::post('/people/bulk',              'PeopleController@bulk')->middleware('auth');
Route::post('/people/bulk/upload',       'PeopleController@bulkUpload')->middleware('auth');
Route::post('/people',                   'PeopleController@store')->middleware('auth');
Route::get('/people/{ID}',               'PeopleController@show')->middleware('auth');
Route::get('/people/delete/{ID}',        'PeopleController@delete')->middleware('auth');
Route::get('/people/{ID}/edit',          'PeopleController@edit')->middleware('auth');
Route::put('/people/{ID}',               'PeopleController@update')->middleware('auth');
Route::post('/newstud',                   'PeopleController@studentCourse')->middleware('auth');

//Clinicals Routes
Route::get('/clinicals/create',          'ClinicalController@create')->middleware('auth');
Route::post('/clinicals',                'ClinicalController@store')->middleware('auth');
Route::get('/clinicals/{ID}',            'ClinicalController@show')->middleware('auth');
Route::get('/clinicals/delete/{ID}',     'ClinicalController@delete')->middleware('auth');
Route::get('/clinicals/{ID}/edit',       'ClinicalController@edit')->middleware('auth');
Route::put('/clinicals/{ID}',            'ClinicalController@update')->middleware('auth');
Route::post('/clinicals/unregister/{ID}', 'ClinicalController@unregister')->middleware('auth');

//Courses Routes
Route::get('/courses/create',          'CoursesController@create')->middleware('auth');
Route::post('/courses',                'CoursesController@store')->middleware('auth');
Route::get('/courses/{ID}',            'CoursesController@show')->middleware('auth');
Route::get('/courses/delete/{ID}',     'CoursesController@delete')->middleware('auth');
Route::get('/courses/{ID}/edit',       'CoursesController@edit')->middleware('auth');
Route::get('/courses/{ID}/assign',     'CoursesController@assign')->middleware('auth');
Route::put('/courses/{ID}',            'CoursesController@update')->middleware('auth');
Route::post('/courses/unregister/{ID}','CoursesController@unregister')->middleware('auth');


Route::get('/settings/clear',          'SettingsController@clear')->middleware('auth');

Route::get('/test',                    'ClinicalController@test')->middleware('auth');

