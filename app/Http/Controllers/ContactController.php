<?php


namespace App\Http\Controllers;


use App\Core\Http\Response\ResponseInterface;

class ContactController extends Controller
{
    public function index(): ResponseInterface
    {
        return view('app/contact/index', [
            'title' => 'Contact Us'
        ]);
    }

    public function sendMessage(): ResponseInterface
    {
        return view('app/contact/send-message', [
            'title' => 'Message us'
        ]);
    }
}