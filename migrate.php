<?php

use App\Core\Database;
use Dotenv\Dotenv;

require 'vendor/autoload.php';

const ROOT_DIR = __DIR__;

//Load environment variables
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$plainSQL = file_get_contents(root_path("storage/database/migrations.sql"));

$pdo = Database::create();

if($pdo->exec($plainSQL) !== false){
    var_dump('Database table migrated successfully.');
}else{
    var_dump('Database table migration failed: ');
}