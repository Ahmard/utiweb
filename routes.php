<?php

use QuickRoute\Route;
use QuickRoute\RouteInterface;

Route::get('/', 'MainController@index');

Route::prefix('movies')->group(function (RouteInterface $route){
    $route->get('/', 'MovieController@index');
    $route->get('fzmovies', 'MovieController@fzmovies');
    $route->get('netnaija', 'MovieController@netnaija');
});

Route::prefix('tvshows')->group(function (RouteInterface $route){
    $route->get('/', 'TVShowController@index');
    $route->get('480mkv-com', 'TVShowController@femkvcom');
});

Route::prefix('api')
    ->namespace('Api')
    ->group(function (RouteInterface $route){
        //MOVIES
        $route->prefix('movies')
            ->namespace('Movies')
            ->group(function (RouteInterface $route){
                $route->get('fzmovies/{url}', 'FZMoviesController@index');
                $route->get('netnaija/{url}', 'NetNaijaController@index');
            });

        //TV SHOWS
        $route->prefix('tvshows')
            ->namespace('TVShows')
            ->group(function (RouteInterface $route){
                $route->get('480mkv-com/{url}', 'FEMkvComController@index');
            });
    });