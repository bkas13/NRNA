<?php

use Illuminate\Support\Facades\Route;

// --------------------------- Individual Candidate ROUTES----------------------------------------------------------------------------

Route::group(
    [
        'as' => 'individual.',
        'namespace' => 'individual',
        'middleware' => ['auth', 'individual-access'],
        'prefix' => 'dashboard/individual'
    ],
    function () {
        Route::view('/index','individual.pages.dashboard')->name('dashboard');


        Route::group([
            'as' => 'news.',
        ], function () {
            Route::get('/news', 'NewsController@index')->name('all');
            Route::get('/addNews', 'NewsController@add')->name('add');
            Route::post('/addNews', 'NewsController@addSubmit')->name('addSubmit');
            Route::get('/editNews/{slug}', 'NewsController@edit')->name('edit');
            Route::post('/updateNews', 'NewsController@update')->name('update');
            Route::get('/deleteNews/{slug}', 'NewsController@destroy')->name('delete');


            //gallery
            Route::get('/gallery/{news_slug}', 'GalleryController@gallery')->name('gallery');
            Route::get('/get_images/{news_id}', 'GalleryController@get_gallery')->name('get_images');
            Route::post('/upload/{news_id}', 'GalleryController@upload')->name('upload_gallery');
            Route::get('/delete_image/{news_id}', 'GalleryController@delete')->name('delete_gallery');
        });


        //contact
        Route::group([
            'as' => 'contact.'
        ], function () {

            Route::get('/contact', 'ContactController@index')->name('all');
            Route::post('/contact', 'ContactController@addSubmit')->name('addContact');
            Route::post('/delete/{id}', 'ContactController@destroy')->name('deleteContact');
        });


        //banner CRUD
        Route::group([
            'as' => 'settings.',
        ], function () {
            Route::get('/banner', 'IndividualSiteSettingController@bannerIndex')->name('bannerIndex');
            Route::get('/addBanner', 'IndividualSiteSettingController@bannerAdd')->name('bannerAdd');
            Route::post('/addBanner', 'IndividualSiteSettingController@bannerAddSubmit')->name('bannerAddSubmit');
            Route::get('/editBanner/{id}', 'IndividualSiteSettingController@bannerEdit')->name('bannerEdit');
            Route::post('/updateBanner/{id}', 'IndividualSiteSettingController@bannerUpdate')->name('bannerUpdate');
            Route::get('/deleteBanner/{id}', 'IndividualSiteSettingController@bannerDestroy')->name('bannerDestroy');

        });

        Route::get('/profile-section','ProfileController@index')->name('profileSection');
        Route::post('/profile-section','ProfileController@update')->name('updateProfileSection');
        Route::get('/personalSiteSetting', 'IndividualSiteSettingController@index')->name('siteSetting');
        Route::post('/personalSiteSetting', 'IndividualSiteSettingController@addSiteSetting')->name('addSiteSetting');
    }
);

// ---------------------------End Individual ROUTES----------------------------------------------------------------------------
