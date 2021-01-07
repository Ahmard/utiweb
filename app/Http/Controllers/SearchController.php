<?php

namespace App\Http\Controllers;


use App\Core\Http\Response\ResponseInterface;

class SearchController extends Controller
{
    public function index(): ResponseInterface
    {
        return view('app/search/index', [
            'title' => 'Search movies/tv shows without ads',
            'desc' => 'Search movies/tv shows without ads',
        ]);
    }

    public function fzmovies(): ResponseInterface
    {
        return view('app/search/fzmovies', [
            'title' => 'Search fzmovies',
            'desc' => 'Search fzmovies movies without ads',
        ]);
    }

    public function femkvcom(): ResponseInterface
    {
        return view('app/search/femkvcom', [
            'title' => 'Search 480mkv.com',
            'desc' => 'Search 480mkv.com tv shows without ads',
        ]);
    }

    public function mobiletvshows(): ResponseInterface
    {
        return view('app/search/mobiletvshows', [
            'title' => 'Search mobiletvshows.net',
            'desc' => 'Search mobiletvshows.net tv shows without ads',
        ]);
    }
}
