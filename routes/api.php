<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => ['auth:api']], function () {

    Route::get('cases/{caseType}', 'ResponseApiController@index');

    Route::get('case-notes/{caseType}/{id}', 'CaseNotesController@index')->name('case-notes.index');
    Route::post('case-notes/{caseType}/{id}', 'CaseNotesController@store')->name('case-notes.create');

    Route::get('upcoming-followups', 'UpcomingFollowupsController@index')->name('api.upcoming-followups');
    Route::get('upcoming-followups/counts', 'UpcomingFollowupsController@counts')->name('api.upcoming-followups.counts');


    Route::resource('users', 'UserController');

    Route::group(['prefix' => 'users'], function () {
        Route::post('{user}/activate', 'UserController@activate');
        Route::post('{user}/deactivate', 'UserController@deactivate');
    });

    Route::get('cards', 'CardsController@index');

});


Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'Auth\AuthController@login');
    Route::post('signup', 'Auth\AuthController@signup');

    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::get('logout', 'Auth\AuthController@logout');
    });
});