<?php


namespace App;


use App\Core\Database;
use PDO;
use Psr\Http\Message\ServerRequestInterface;

class Notification
{
    public static function create(ServerRequestInterface $request)
    {
        $postedData = $request->getParsedBody();
        $pdo = Database::create();
        $prepared = $pdo->prepare("INSERT INTO notifications(notification, status) VALUES (:notification, :status)");
        $prepared->bindValue(':notification', base64_encode($postedData['notification']));
        $prepared->bindValue(':status', 1);
        $prepared->execute();

        return $pdo->lastInsertId();
    }

    public static function update(ServerRequestInterface $request, int $notificationId)
    {
        $postedData = $request->getParsedBody();
        $pdo = Database::create();
        $pdo->setAttribute(PDO::ERRMODE_EXCEPTION, true);
        $prepared = $pdo->prepare("UPDATE notifications SET notification = :notification WHERE id = :id;");
        $prepared->bindValue(':notification', base64_encode($postedData['notification']));
        $prepared->bindValue(':id', $notificationId);
        $prepared->execute();

        return true;
    }

    public static function delete(int $notificationId)
    {
        $connection = Database::create();
        $connection->query("DELETE FROM notifications WHERE id = {$notificationId};");

        return true;
    }

    public static function get(int $notificationId)
    {
        $connection = Database::create();
        $result = $connection->query("SELECT * FROM notifications WHERE id = {$notificationId};");
        $notification = $result->fetch(PDO::FETCH_ASSOC);
        $notification['notification'] = base64_decode($notification['notification']);

        return $notification;
    }

    public static function getAll()
    {
        $notifications =  Database::create()
            ->query('SELECT * FROM notifications WHERE status = 1')
            ->fetchAll(PDO::FETCH_ASSOC);

        for ($i = 0; $i < count($notifications); $i++) {
            $notifications[$i]['notification'] = base64_decode($notifications[$i]['notification']);
        }

        return $notifications;
    }
}