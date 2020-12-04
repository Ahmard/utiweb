<?php

namespace App\Http\Controllers;


use Uticlass\Video\Search\FZMoviesSearch;

class SearchController extends Controller
{
    public function index()
    {
        return view('app/search/index');
    }

    public function fzmovies()
    {
        return view('app/search/fzmovies');
    }

    public function femkvcom()
    {
        return view('app/search/femkvcom');
    }
}
