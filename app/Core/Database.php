<?php


namespace App\Core;


class Database
{
    private static \PDO $pdo;

    public static function create()
    {
        if(! isset(static::$pdo)){
            $dbFile = root_path($_ENV['DB_FILE']);
            static::$pdo = new \PDO("sqlite:{$dbFile}");
        }

        return static::$pdo;
    }
}