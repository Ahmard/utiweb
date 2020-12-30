<?php


namespace App\Http\Controllers;


use App\Core\Http\Response\ResponseInterface;

class MovieController extends Controller
{
    public function index(): ResponseInterface
    {
        return view('app/movies/index.twig', [
            'title' => 'Movie downloader',
            'desc' => 'Extract movie download link.',
            'keywords' => 'movie downloader, movie link extractor, movie ad bypass'
        ]);
    }

    public function fzmovies(): ResponseInterface
    {
        return view('app/movies/fzmovies.twig', [
            'title' => 'FZMovies downloader',
            'desc' => 'Fzmovies.net download link extractor/downloader.',
            'keywords' => 'fzmovies downloader, fzmovies download link extractor'
        ]);
    }

    public function netnaija(): ResponseInterface
    {
        return view('app/movies/netnaija.twig', [
            'title' => 'NetNaija downloader',
            'desc' => 'NetNaija|TheNetNaija.com download link extractor/downloader.',
            'keywords' => 'netnaija downloader, netnaija download link extractor'
        ]);
    }

    public function coolmoviez(): ResponseInterface
    {
        return view('app/movies/coolmoviez.twig', [
            'title' => 'CoolMoviez downloader',
            'desc' => 'CoolMoviez|MyCoolMoviez|CooLmovieZ.live download link extractor/downloader.',
            'keywords' => 'CooLmovieZ.live, coolmoviez.shop, mycoolmoviez, coolmoviez downloader, coolmoviez download link extractor'
        ]);
    }
}