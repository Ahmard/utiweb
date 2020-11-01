<?php


namespace App\Http\Controllers;


class ContactController extends Controller
{
    public function index()
    {
        return view('app/contact/index', [
            'title' => 'Contact Us'
        ]);
    }

    public function sendMessage()
    {
        return view('app/contact/send-message', [
            'title' => 'Message us'
        ]);
    }
}