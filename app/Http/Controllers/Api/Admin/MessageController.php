<?php


namespace App\Http\Controllers\Api\Admin;


use App\Core\Database;
use App\Http\Controllers\Controller;
use Psr\Http\Message\ServerRequestInterface;

class MessageController extends Controller
{
    public function markAsRead(ServerRequestInterface $request, array $params)
    {
        $connection = Database::create();
        $connection->query("UPDATE messages SET status = 1 WHERE id = {$params['messageId']};");

        return response()->json()->success([
            'message' => 'Message has been marked as read.'
        ]);
    }

    public function delete(ServerRequestInterface $request, array $params)
    {
        $connection = Database::create();
        $result = $connection->query("DELETE FROM messages WHERE id = {$params['messageId']};");

        return response()->json()->success([
            'message' => 'Message has been deleted.'
        ]);
    }
}