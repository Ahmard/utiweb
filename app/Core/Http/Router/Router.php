<?php


namespace App\Core\Http\Router;


use App\Core\Http\Response\ResponseInterface;
use Exception;
use Psr\Http\Message\ServerRequestInterface;
use WebRoute\DispatchResult;

class Router
{
    /**
     * @param ServerRequestInterface $request
     * @param DispatchResult $dispatchResult
     * @return ResponseInterface|Exception|mixed
     */
    public static function route(ServerRequestInterface $request, DispatchResult $dispatchResult)
    {
        $response = null;
        switch (true) {
            case $dispatchResult->isFound():
                $response = Matcher::match($request, $dispatchResult);
                break;
            case $dispatchResult->isNotFound():
                $response = response()->notFound();
                break;
            case $dispatchResult->isMethodNotAllowed():
                $response = response()->methodNotAllowed();
                break;
            default:
                $response = response()->internalServerError();
        }

        return $response;
    }
}