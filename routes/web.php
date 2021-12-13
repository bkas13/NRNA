<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::group([
    'as' => 'front.',
    'namespace' => 'front',
], function () {
    Route::get('/', 'IndexController@home')->name('home');
    Route::post('/', 'IndexController@homeContact')->name('homeContact');

    Route::get('/{user}', 'IndexController@userHome')->name('userHome');
    Route::get('/{user}/contact', 'IndexController@userContact')->name('userContact');
    Route::post('/{user}/contact', 'IndexController@userContactSubmit')->name('userContact.submit');
    Route::get('/{user}/about', 'IndexController@userAbout')->name('userAbout');
    Route::get('/{user}/news', 'NewsController@index')->name('news');
    Route::get('/{user}/news/{slug}', 'NewsController@singleNews')->name('singleNews');
    Route::get('/{user}/committee/{slug}', 'CommitteeController@index')->name('singleCommittee');
    Route::get('/{candidate}/profile','CommitteeController@candidateProfile')->name('individualProfile');
});

// ---------------AUTHENTICATION ROUTES----------------------------------------------------------------------------
Route::group(
    [
        'as' => 'auth.',
        'namespace' => 'auth',
        'middleware' => ['guest']
    ],
    function () {

        Route::get('/user/login', 'LoginController@login')->name('login');
        Route::post('/user/login', 'LoginController@loginSubmit')->name('loginSubmit');
    }
);
Route::post('/logout', 'auth\LoginController@logout')->name('logout');

Route::get('/user/change_password','auth\ProfileController@profile')->name('auth.profile')->middleware('auth');
Route::post('/user/change_password','auth\ProfileController@changePassword')->name('auth.changePassword')->middleware('auth');

#***************Additional Routes are located in <app_folder>/routes/privateRoutes/***********#
