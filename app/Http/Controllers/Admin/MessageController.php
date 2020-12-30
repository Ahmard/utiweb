<?php


namespace App\Http\Controllers\Admin;


use App\Core\Database;
use App\Core\Http\Response\ResponseInterface;
use App\Http\Controllers\Controller;
use PDO;

class MessageController extends Controller
{
    public function readied(): ResponseInterface
    {
        $connection = Database::create();
        $query = $connection->query('SELECT * FROM messages WHERE status = 1');
        $messages = $query->fetchAll(PDO::FETCH_ASSOC);

        return view('app/admin/message/readied', [
            'messages' => $messages
        ]);
    }

    public function unread(): ResponseInterface
    {
        return $this->index();
    }

    public function index(): ResponseInterface
    {
        $connection = Database::create();
        $query = $connection->query('SELECT * FROM messages WHERE status = 0');
        $messages = $query->fetchAll(PDO::FETCH_ASSOC);

        return view('app/admin/message/index', [
            'messages' => $messages
        ]);
    }
}