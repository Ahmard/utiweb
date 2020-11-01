<?php


namespace App\Http\Controllers;


class OthersController extends Controller
{
    public function index()
    {
        return view('app/others/index');
    }

    public function zippyShare()
    {
        return view('app/others/zippyshare');
    }
}