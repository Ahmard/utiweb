<?php


namespace App\Http\Controllers;


use App\Core\Http\Response\ResponseInterface;

class OthersController extends Controller
{
    public function index(): ResponseInterface
    {
        return view('app/others/index', [
            'title' => 'File Downloader',
            'desc' => 'Extract file download link.',
            'keywords' => 'file downloader, file link extractor, file ad bypass'
        ]);
    }

    public function zippyShare(): ResponseInterface
    {
        return view('app/others/zippyshare', [
            'title' => 'ZippyShare downloader',
            'desc' => 'Extract zippyshare download link.',
            'keywords' => 'zippyshare downloader, zippyshare link extractor, zippyshare ad bypass'
        ]);
    }

    public function fireFiles(): ResponseInterface
    {
        return view('app/others/firefiles', [
            'title' => 'FireFiles downloader',
            'desc' => 'Extract firefiles download link.',
            'keywords' => 'firefiles downloader, firefiles link extractor, firefiles ad bypass'
        ]);
    }
}