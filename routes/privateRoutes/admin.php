<?php


// ---------------------------ADMIN ROUTES----------------------------------------------------------------------------

use Illuminate\Support\Facades\Route;

Route::group(
    [
        'as' => 'admin.',
        'namespace' => 'admin',
        'prefix' => 'dashboard/admin',
        'middleware' => ['auth', 'admin-access']
    ],
    function () {

        Route::view('/index', 'admin.pages.dashboard')->name('dashboard');


        Route::group([
            'as' => 'user.',
            'prefix' => 'users'
        ], function () {
            Route::get('/', 'UserController@index')->name('all');
            Route::get('/add', 'UserController@add')->name('add');
            Route::post('/add', 'UserController@addSubmit')->name('addSubmit');
            Route::get('/edit/{username}', 'UserController@edit')->name('edit');
            Route::post('/edit/{username}', 'UserController@update')->name('update');
            Route::get('/toggleAtive/{username}','UserController@toggleActive')->name('toggleActive');
        });

        // Route::group([
        //     'as' => 'candidate.',
        // ], function () {
        //     Route::get('/candidate', 'CandidateController@index')->name('all');
        //     Route::get('/addCandidate', 'CandidateController@add')->name('add');
        //     Route::post('/addCandidate', 'CandidateController@addSubmit')->name('addSubmit');
        //     Route::get('/editCandidate/{slug}', 'CandidateController@edit')->name('edit');
        //     Route::post('/updateCandidate', 'CandidateController@update')->name('update');
        //     Route::get('/deleteCandidate/{slug}', 'CandidateController@destroy')->name('delete');
        // });
        // Route::group([
        //     'as' => 'news.',
        // ], function () {
        //     Route::get('/news', 'NewsController@index')->name('all');
        //     Route::get('/addNews', 'NewsController@add')->name('add');
        //     Route::post('/addNews', 'NewsController@addSubmit')->name('addSubmit');
        //     Route::get('/editNews/{slug}', 'NewsController@edit')->name('edit');
        //     Route::post('/updateNews', 'NewsController@update')->name('update');
        //     Route::get('/deleteNews/{slug}', 'NewsController@destroy')->name('delete');


        //     //gallery
        //     Route::get('/gallery/{news_slug}', 'GalleryController@gallery')->name('gallery');
        //     Route::get('/get_images/{news_id}', 'GalleryController@get_gallery')->name('get_images');
        //     Route::post('/upload/{news_id}', 'GalleryController@upload')->name('upload_gallery');
        //     Route::get('/delete_image/{news_id}', 'GalleryController@delete')->name('delete_gallery');
        // });

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
            Route::get('/banner', 'AdminSiteSettingController@bannerIndex')->name('bannerIndex');
            Route::get('/addBanner', 'AdminSiteSettingController@bannerAdd')->name('bannerAdd');
            Route::post('/addBanner', 'AdminSiteSettingController@bannerAddSubmit')->name('bannerAddSubmit');
            Route::get('/editBanner/{id}', 'AdminSiteSettingController@bannerEdit')->name('bannerEdit');
            Route::post('/updateBanner/{id}', 'AdminSiteSettingController@bannerUpdate')->name('bannerUpdate');
            Route::get('/deleteBanner/{id}', 'AdminSiteSettingController@bannerDestroy')->name('bannerDestroy');
        });
        Route::get('/update/siteSetting', 'AdminSiteSettingController@index')->name('siteSetting');
        Route::post('/update/siteSetting', 'AdminSiteSettingController@addSiteSetting')->name('addRegionSiteSetting');
    }
);

