<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Notification;
use Psr\Http\Message\ServerRequestInterface;

class NotificationController extends Controller
{

    public function index()
    {
        return view('app/admin/notification/index');
    }

    public function update(ServerRequestInterface $request, array $params)
    {
        return view('app/admin/notification/update', [
            'notification' => Notification::get($params['id']),
        ]);
    }

}