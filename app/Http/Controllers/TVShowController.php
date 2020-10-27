<?php


namespace App\Http\Controllers;


class TVShowController extends Controller
{
    public function index()
    {
        return view('app/tvshow/index');
    }

    public function femkvcom()
    {
        return view('app/tvshow/480mkv-com');
    }
}