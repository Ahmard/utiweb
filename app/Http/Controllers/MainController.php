<?php

namespace App\Http\Controllers;


use Psr\Http\Message\ServerRequestInterface;

class MainController extends Controller
{
    public function index()
    {
        return view('index.twig');
    }
}
