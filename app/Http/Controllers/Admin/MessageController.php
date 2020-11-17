<?php


namespace App\Http\Controllers\Admin;


use App\Core\Database;
use App\Http\Controllers\Controller;
use PDO;

class MessageController extends Controller
{
    public function readied()
    {
        $connection = Database::create();
        $query = $connection->query('SELECT * FROM messages WHERE status = 1');
        $messages = $query->fetchAll(PDO::FETCH_ASSOC);

        return view('app/admin/message/readied', [
            'messages' => $messages
        ]);
    }

    public function unread()
    {
        return $this->index();
    }

    public function index()
    {
        $connection = Database::create();
        $query = $connection->query('SELECT * FROM messages WHERE status = 0');
        $messages = $query->fetchAll(PDO::FETCH_ASSOC);

        return view('app/admin/message/index', [
            'messages' => $messages
        ]);
    }
}