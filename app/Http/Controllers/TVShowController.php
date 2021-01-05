<?php


namespace App\Http\Controllers;


use App\Core\Http\Response\ResponseInterface;

class TVShowController extends Controller
{
    public function index(): ResponseInterface
    {
        return view('app/tvshow/index', [
            'title' => 'TV Show downloader',
            'desc' => 'Extract tv show download link.',
            'keywords' => 'tv show downloader, tv show link extractor, tv show ad bypass'
        ]);
    }

    public function femkvcom(): ResponseInterface
    {
        return view('app/tvshow/480mkv-com', [
            'title' => '480mkv.com downloader',
            'desc' => 'Extract 480mkv.com show download link.',
            'keywords' => '480mkv downloader, 480mkv link extractor, 480mkv ad bypass'
        ]);
    }

    public function o2tvseriescom(): ResponseInterface
    {
        return view('app/tvshow/o2tvseries-com', [
            'title' => 'O2tvseries.com downloader',
            'desc' => 'Extract o2tvseries.com show download link.',
            'keywords' => 'o2tvseries downloader, o2tvseries link extractor, o2tvseries ad bypass'
        ]);
    }

    public function o2tvseriescoza(): ResponseInterface
    {
        return view('app/tvshow/o2tvseries-co-za', [
            'title' => 'O2tvseries.co.za downloader',
            'desc' => 'Extract o2tvseries.co.za show download link.',
            'keywords' => 'o2tvseries downloader, o2tvseries link extractor, o2tvseries ad bypass'
        ]);
    }

    public function mobiletvshows(): ResponseInterface
    {
        return view('app/tvshow/mobiletvshows', [
            'title' => 'mobiletvshows.net downloader',
            'desc' => 'Extract mobiletvshows.net show download link.',
            'keywords' => 'mobiletvshows downloader, mobiletvshows link extractor, mobiletvshows ad bypass'
        ]);
    }
}