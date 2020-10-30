<?php

use App\Core\Helpers\Classes\RequestHelper;
use App\Core\Http\Response\InternalServerErrorResponse;
use App\Core\Http\Response\ResponseInterface;
use App\Core\Http\Router\Dispatcher;
use App\Core\Http\Router\Router;
use App\Core\ResponseGenerator;
use Dotenv\Dotenv;
use Sunrise\Http\ServerRequest\ServerRequestFactory;

$uri = $_SERVER['REQUEST_URI'];
if ('/' !== $uri && file_exists($uri)) {
    return false;
}

require 'vendor/autoload.php';

//Create request instance
$request = ServerRequestFactory::fromGlobals();


/**
 * @param Throwable $exception
 */
function handleApplicationException(Throwable $exception)
{
    global $request;
    //Save error log
    $filename = __DIR__ . '/storage/logs/error-' . date('d_m_Y-H_i_s') . '.log';
    file_put_contents($filename, $exception);

    //Send server error response to client
    InternalServerErrorResponse::create($exception)->send($request);
}

//Handle all exceptions thrown
set_exception_handler('handleApplicationException');

//Load environment variables
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

//Http request helper
RequestHelper::setRequest($request);

//Helper functions
require('app/Core/Helpers/generalHelperFunctions.php');
require('app/Core/Helpers/httpHelperFunctions.php');

$response = null;
try {
    //Router dispatch result
    $dispatchResult = Dispatcher::dispatch($request);

    //Execution response
    $response = Router::route($request, $dispatchResult);

    if($response instanceof Throwable){
        handleApplicationException($response);
    }
} catch (Throwable $throwable) {
    handleApplicationException($throwable);
}

//Send response to browser
ResponseGenerator::generate($response)->send($request);