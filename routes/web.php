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



Route::get('/profile', function () {
    return view('firmProfile');
});

Route::get('/seeker', function () {
    return view('seeker');
});

Route::get('/firms', function () {
    return view('firms');
});