<?php


namespace App\Http\Controllers;


class TVShowController extends Controller
{
    public function index()
    {
        return view('app/tvshow/index', [
            'title' => 'TV Show downloader',
            'desc' => 'Extract tv show download link.',
            'keywords' => 'tv show downloader, tv show link extractor, tv show ad bypass'
        ]);
    }

    public function femkvcom()
    {
        return view('app/tvshow/480mkv-com', [
            'title' => '480mkv.com downloader',
            'desc' => 'Extract 480mkv.com show download link.',
            'keywords' => '480mkv downloader, 480mkv link extractor, 480mkv ad bypass'
        ]);
    }

    public function o2tvseriescom()
    {
        return view('app/tvshow/o2tvseries-com', [
            'title' => 'O2tvseries.com downloader',
            'desc' => 'Extract o2tvseries.com show download link.',
            'keywords' => 'o2tvseries downloader, o2tvseries link extractor, o2tvseries ad bypass'
        ]);
    }

    public function o2tvseriescoza()
    {
        return view('app/tvshow/o2tvseries-co-za', [
            'title' => 'O2tvseries.co.za downloader',
            'desc' => 'Extract o2tvseries.co.za show download link.',
            'keywords' => 'o2tvseries downloader, o2tvseries link extractor, o2tvseries ad bypass'
        ]);
    }
}