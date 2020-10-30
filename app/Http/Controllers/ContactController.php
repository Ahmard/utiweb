<?php


namespace App\Http\Controllers;


class ContactController extends Controller
{
    public function index()
    {
        return view('app/contact/index');
    }

    public function sendMessage()
    {
        return view('app/contact/send-message');
    }
}