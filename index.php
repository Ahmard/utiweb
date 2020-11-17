<?php

if ('production' === $_ENV['APP_ENVIRONMENT']) {
    error_reporting(E_ERROR);
}

use App\Core\Helpers\Classes\RequestHelper;
use App\Core\Http\RequestHandler;
use App\Core\Http\Response\InternalServerErrorResponse;
use App\Core\ResponseGenerator;
use Dotenv\Dotenv;
use Laminas\Diactoros\ServerRequestFactory;

$uri = $_SERVER['REQUEST_URI'];
if ('/' !== $uri && file_exists($uri)) {
    return false;
}

$start = microtime(true);
require 'vendor/autoload.php';

//Create request instance
$request = ServerRequestFactory::fromGlobals();


/**
 * @param Throwable $exception
 * @param bool $willTerminate
 */
function handleApplicationException(Throwable $exception, $willTerminate = true)
{
    global $request;
    //Save error log
    $filename = __DIR__ . '/storage/logs/error/' . date('d_m_Y-H_i_s') . '.log';
    file_put_contents($filename, json_encode([
        'file' => $exception->getFile(),
        'line' => $exception->getLine(),
        'message' => $exception->getMessage(),
        'trace' => $exception->getTraceAsString(),
    ], JSON_PRETTY_PRINT));

    if ($willTerminate) {
        //Send server error response to client
        InternalServerErrorResponse::create($exception)->send($request);
    }
}

//Handle all exceptions thrown
set_exception_handler('handleApplicationException');

try {
    //Load environment variables
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    //Http request helper
    RequestHelper::setRequest($request);

    //Helper functions
    require('app/Core/Helpers/generalHelperFunctions.php');
    require('app/Core/Helpers/httpHelperFunctions.php');

    $response = RequestHandler::handle($request);

    //Send response to browser
    ResponseGenerator::generate($response)->send($request);
} catch (Throwable $exception) {
    handleApplicationException($exception);
}