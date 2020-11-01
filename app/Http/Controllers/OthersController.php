<?php


namespace App\Http\Controllers;


class OthersController extends Controller
{
    public function index()
    {
        return view('app/others/index', [
            'title' => 'File Downloader',
            'desc' => 'Extract file download link.',
            'keywords' => 'file downloader, file link extractor, file ad bypass'
        ]);
    }

    public function zippyShare()
    {
        return view('app/others/zippyshare', [
            'title' => 'ZippyShare downloader',
            'desc' => 'Extract zippyshare download link.',
            'keywords' => 'zippyshare downloader, zippyshare link extractor, zippyshare ad bypass'
        ]);
    }
}