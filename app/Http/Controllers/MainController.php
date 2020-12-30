<?php

namespace App\Http\Controllers;


use App\Core\Http\Response\ResponseInterface;

class MainController extends Controller
{
    public function index(): ResponseInterface
    {
        return view('index.twig');
    }
}
