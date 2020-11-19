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
                Route::get('/', 'MainController@index');

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
});

Route::prefix('others')->group(function () {
    Route::get('/', 'OthersController@index');
    Route::get('zippyshare', 'OthersController@zippyShare');
});

Route::prefix('api')
    ->namespace('Api')
    ->group(function () {

        //ADMIN
        Route::prefix('admin')
            ->namespace('Admin')
            ->append('{token}')
            ->group(function () {
                //Message
                Route::prefix('message')->group(function () {
                    Route::patch('{messageId}', 'MessageController@markAsRead');
                    Route::delete('{messageId}', 'MessageController@delete');
                });

                //Error
                Route::prefix('error')->group(function (){
                    Route::delete('/', 'ErrorController@delete');
                });
            });

        //CONTACT
        Route::prefix('contact')
            ->namespace('Contact')
            ->group(function () {
                Route::post('send-message', 'MessageController@sendMessage');
            });

        //MOVIES
        Route::prefix('movies')
            ->namespace('Movies')
            ->group(function () {
                Route::get('fzmovies/{chosen}/{url}', 'FZMoviesController@index');
                Route::get('netnaija/{url}', 'NetNaijaController@index');
                Route::get('coolmoviez/{url}', 'CoolMoviezController@index');
            });

        //TV SHOWS
        Route::prefix('tvshows')
            ->namespace('TVShows')
            ->group(function () {
                Route::get('480mkv-com/{url}', 'FEMkvComController@index');
                Route::get('o2tvseries-com/{url}', 'O2TvSeriesComController@index');
                Route::get('o2tvseries-co-za/{url}', 'O2TvSeriesCoZaController@index');
            });

        //OTHERS
        Route::prefix('others')
            ->namespace('Others')
            ->group(function () {
                Route::get('zippyshare/{url}', 'ZippyShareController@index');
            });
    });