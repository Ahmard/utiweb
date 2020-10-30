<?php

use App\Core\Database;
use Dotenv\Dotenv;

require 'vendor/autoload.php';

//Load environment variables
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

//Helper functions
require('app/Core/Helpers/generalHelperFunctions.php');

$plainSQL = file_get_contents(root_path("storage/database/migrations.sql"));

$pdo = Database::create();

if($pdo->exec($plainSQL) !== false){
    var_dump('Database table migrated successfully.');
}else{
    var_dump('Database table migration failed: ');
}