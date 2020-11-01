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
}