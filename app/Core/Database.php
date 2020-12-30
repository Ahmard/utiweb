<?php


namespace App\Core;


use PDO;

class Database
{
    private static PDO $pdo;

    public static function create(): PDO
    {
        if (!isset(static::$pdo)) {
            $dbFile = root_path($_ENV['DB_FILE']);
            static::$pdo = new PDO("sqlite:{$dbFile}");
            static::$pdo->setAttribute(PDO::ERRMODE_EXCEPTION, true);
        }

        return static::$pdo;
    }
}