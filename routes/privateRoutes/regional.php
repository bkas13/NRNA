<?php

// ---------------------------Regional ROUTES----------------------------------------------------------------------------

use Illuminate\Support\Facades\Route;

Route::group(
    [
        'as' => 'region.',
        'namespace' => 'region',
        'middleware' => ['auth', 'region-access'],
        'prefix' => 'dashboard/region'
    ],
    function () {

        Route::view('/index', 'region.pages.dashboard')->name('dashboard');

        Route::group([
            'as' => 'committee.',
        ], function () {
            Route::get('/committee', 'CommitteeController@index')->name('all');
            Route::get('/add_committee', 'CommitteeController@add')->name('add');
            Route::post('/add_committee', 'CommitteeController@addSubmit')->name('addSubmit');
            Route::get('/edit_committee/{slug}', 'CommitteeController@edit')->name('edit');
            Route::post('/update_committee', 'CommitteeController@update')->name('update');
            Route::get('/delete_committee/{slug}', 'CommitteeController@destroy')->name('delete');

            Route::get('/committee-profile/{slug}', 'CommitteeController@profile')->name('profile');
            Route::post('/committee-profile/{slug}', 'CommitteeController@updateProfile')->name('update_profile');
        });

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
            Route::get('/banner', 'RegionSiteSettingController@bannerIndex')->name('bannerIndex');
            Route::get('/addBanner', 'RegionSiteSettingController@bannerAdd')->name('bannerAdd');
            Route::post('/addBanner', 'RegionSiteSettingController@bannerAddSubmit')->name('bannerAddSubmit');
            Route::get('/editBanner/{id}', 'RegionSiteSettingController@bannerEdit')->name('bannerEdit');
            Route::post('/updateBanner/{id}', 'RegionSiteSettingController@bannerUpdate')->name('bannerUpdate');
            Route::get('/deleteBanner/{id}', 'RegionSiteSettingController@bannerDestroy')->name('bannerDestroy');

        });
        Route::get('/regionSiteSetting', 'RegionSiteSettingController@index')->name('regionSiteSetting');
        Route::post('/regionSiteSetting', 'RegionSiteSettingController@addSiteSetting')->name('addRegionSiteSetting');
    }
);

// ---------------------------End Regional ROUTES----------------------------------------------------------------------------
