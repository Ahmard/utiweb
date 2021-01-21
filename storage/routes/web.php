<?php

use QuickRoute\Route;

Route::get('/', 'MainController@index');

Route::prefix('admin')
    ->namespace('Admin')
    ->group(function () {
        Route::get('/', 'MainController@index');
        Route::post('/login', 'MainController@login');

        //Protected routes
        Route::middleware('admin')
            ->append('{token}')
            ->group(function () {
                //Homepage
                Route::get('/', 'MainController@index');
                //Site Statistic
                Route::get('/statistic', 'MainController@statistic');

                //Site Notifications
                Route::prefix('notification')->group(function () {
                    Route::get('/', 'NotificationController@index');
                    Route::get('{id}', 'NotificationController@update');
                });

                //Messaging
                Route::prefix('message')->group(function () {
                    Route::get('/', 'MessageController@index');
                    Route::get('/readied', 'MessageController@readied');
                    Route::get('/unread', 'MessageController@unread');
                });

                //Error
                Route::prefix('error')->group(function () {
                    Route::get('/', 'ErrorController@index');
                    Route::post('delete', 'MainController@delete');
                });
            });
    });

Route::prefix('contact')->group(function () {
    Route::get('/', 'ContactController@index');
    Route::get('send-message', 'ContactController@sendMessage');
});

Route::prefix('movies')->group(function () {
    Route::get('/', 'MovieController@index');
    Route::get('fzmovies', 'MovieController@fzmovies');
    Route::get('netnaija', 'MovieController@netnaija');
    Route::get('coolmoviez', 'MovieController@coolmoviez');
});

Route::prefix('tvshows')->group(function () {
    Route::get('/', 'TVShowController@index');
    Route::get('480mkv-com', 'TVShowController@femkvcom');
    Route::get('o2tvseries-com', 'TVShowController@o2tvseriescom');
    Route::get('o2tvseries-co-za', 'TVShowController@o2tvseriescoza');
    Route::get('mobiletvshows', 'TVShowController@mobiletvshows');
});

Route::prefix('others')->group(function () {
    Route::get('/', 'OthersController@index');
    Route::get('zippers', 'OthersController@zippyShare');
    Route::get('firefiles', 'OthersController@fireFiles');
});

Route::prefix('search')->group(function (){
    Route::get('/', 'SearchController@index');
    Route::get('fzmovies', 'SearchController@fzmovies');
    Route::get('480mkvcom', 'SearchController@femkvcom');
    Route::get('mobiletvshows', 'SearchController@mobiletvshows');
    Route::get('netnaija', 'SearchController@netnaija');
});