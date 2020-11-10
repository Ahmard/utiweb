<?php

use QuickRoute\Route;

Route::get('/', 'MainController@index');

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
});

Route::prefix('others')->group(function (){
    Route::get('/', 'OthersController@index');
    Route::get('zippyshare', 'OthersController@zippyShare');
});

Route::prefix('api')
    ->namespace('Api')
    ->group(function () {
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
            });

        //OTHERS
        Route::prefix('others')
            ->namespace('Others')
            ->group(function () {
                Route::get('zippyshare/{url}', 'ZippyShareController@index');
            });
    });