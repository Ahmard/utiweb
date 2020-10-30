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
});

Route::prefix('tvshows')->group(function () {
    Route::get('/', 'TVShowController@index');
    Route::get('480mkv-com', 'TVShowController@femkvcom');
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
                Route::get('fzmovies/{url}', 'FZMoviesController@index');
                Route::get('netnaija/{url}', 'NetNaijaController@index');
            });

        //TV SHOWS
        Route::prefix('tvshows')
            ->namespace('TVShows')
            ->group(function () {
                Route::get('480mkv-com/{url}', 'FEMkvComController@index');
            });
    });