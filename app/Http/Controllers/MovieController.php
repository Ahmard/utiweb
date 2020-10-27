<?php


namespace App\Http\Controllers;


class MovieController extends Controller
{
    public function index()
    {
        return view('app/movies/index.twig');
    }

    public function fzmovies()
    {
        return view('app/movies/fzmovies.twig');
    }

    public function netnaija()
    {
        return view('app/movies/netnaija.twig');
    }
}