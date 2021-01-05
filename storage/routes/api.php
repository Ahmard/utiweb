<?php

use QuickRoute\Route;

//ADMIN
Route::prefix('admin')
    ->namespace('Admin')
    ->middleware('admin')
    ->append('{token}')
    ->group(function () {
        //Delete Statistic
        Route::delete('statistic', 'MainController@deleteStatistics');

        //Message
        Route::prefix('message')->group(function () {
            Route::patch('{messageId}', 'MessageController@markAsRead');
            Route::delete('{messageId}', 'MessageController@delete');
        });

        //NOTIFICATION
        Route::prefix('notification')->group(function () {
            Route::get('{id}', 'NotificationController@view');
            Route::post('/', 'NotificationController@create');
            Route::get('/', 'NotificationController@create');
            Route::post('{id}', 'NotificationController@update');
            Route::delete('{id}', 'NotificationController@delete');
        });

        //Error
        Route::prefix('error')->group(function () {
            Route::delete('/', 'ErrorController@delete');
        });
    });

//CONTACT
Route::prefix('contact')
    ->namespace('Contact')
    ->group(function () {
        Route::post('send-message', 'MessageController@sendMessage');
    });

Route::name('scrapper.')->group(function () {
    //SEARCHES
    Route::prefix('search')
        ->name('search')
        ->group(function () {
            Route::get('fzmovies', 'SearchController@fzmovies');
            Route::get('femkvcom', 'SearchController@femkvcom');
            Route::get('mobiletvshows', 'SearchController@mobiletvshows');
        });

    //EXTRACTIONS
    Route::append('{url}')
        ->name('extractor')
        ->middleware('url')
        ->group(function () {
            //MOVIES
            Route::prefix('movies')
                ->namespace('Movies')
                ->group(function () {
                    Route::get('fzmovies/{chosen}', 'FZMoviesController@index');
                    Route::get('netnaija', 'NetNaijaController@index');
                    Route::get('coolmoviez', 'CoolMoviezController@index');
                });

            //TV SHOWS
            Route::prefix('tvshows')
                ->namespace('TVShows')
                ->group(function () {
                    Route::get('480mkv-com', 'FEMkvComController@index');
                    Route::get('o2tvseries-com', 'O2TvSeriesComController@index');
                    Route::get('o2tvseries-co-za', 'O2TvSeriesCoZaController@index');
                    Route::get('mobiletvshows', 'MobileTVShowsController@index');
                });

            //OTHERS
            Route::prefix('others')
                ->namespace('Others')
                ->group(function () {
                    Route::get('zippyshare', 'ZippyShareController@index');
                });
        });
});
