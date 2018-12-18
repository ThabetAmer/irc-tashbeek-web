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

Route::group(['middleware' => ['web','auth']],function(){
    Route::get('/','HomeController@index');
    Route::get('/job-seekers','JobSeekerController@index');
    Route::get('/job-seekers/{jobSeeker}','JobSeekerController@show');
});

//
Route::get('/dashboard', function () {
//    return redirect()->route('login');
    return view('home');
});


Route::get('/home', 'HomeController@index')->name('home');
Route::get('index/{case_type}', 'ResponseApiController@index');

Route::get('/dashboard', function (){
    return view('home');
});



Route::get('/firm', function () {
    return view('firmProfile');
});

Route::get('/seeker', function () {
    return view('seekerProfile');
});

Route::get('/allSeekers', function () {
    return view('allSeekers');
});

Route::get('/allFirms', function () {
    return view('allFirms');
});