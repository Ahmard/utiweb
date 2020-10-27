<?php

use App\Core\Http\Router\Dispatcher;
use App\Core\Http\Router\Router;
use Dotenv\Dotenv;
use Sunrise\Http\ServerRequest\ServerRequestFactory;

if ('/' !== $_SERVER['REQUEST_URI'] && file_exists($_SERVER['REQUEST_URI'])) {
    return false;
}

require 'vendor/autoload.php';


//Load environment variables
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

//Create request instance
$request = ServerRequestFactory::fromGlobals();

//Router dispatch result
$dispatchResult = Dispatcher::dispatch($request);

//Execution response
$response = Router::route($request, $dispatchResult);

dump($response);