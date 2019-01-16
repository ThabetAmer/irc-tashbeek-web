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

Auth::routes();

Route::group([

    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [
        'localize',
        'web',
        'auth'
    ]

], function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::get('/job-seekers', 'JobSeekerController@index')->name('job-seekers');
    Route::get('/job-seekers/{jobSeeker}', 'JobSeekerController@show')->name('job-seekers.show');

    Route::get('/firms', 'FirmController@index')->name('firms');
    Route::get('/firms/{firm}', 'FirmController@show');

    Route::get('/users', 'UserControllerView@index')->name('users');
    Route::get('/users/create', 'UserControllerView@create')->name('users.create');
    Route::get('/users/{user}/edit', 'UserControllerView@edit')->name('users.edit');
    Route::get('/users/{user}', 'UserControllerView@show')->name('users.show');

    Route::get('/job-openings', 'JobOpeningController@index')->name('job-openings');
    Route::get('/job-openings/{jobOpening}/match', 'JobOpeningMatchController@index')->name('job-openings.match');
});