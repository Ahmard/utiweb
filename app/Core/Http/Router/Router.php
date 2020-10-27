<?php


namespace App\Core\Http\Router;


use Psr\Http\Message\ServerRequestInterface;
use WebRoute\DispatchResult;

class Router
{
    public static function route(ServerRequestInterface $request, DispatchResult $dispatchResult)
    {
        $response = null;
        switch (true) {
            case $dispatchResult->isFound():
                $response = Matcher::match($request, $dispatchResult);
                break;
            case $dispatchResult->isNotFound():
                echo "Page not found";
                break;
            case $dispatchResult->isMethodNotAllowed():
                echo "Request method not allowed";
                break;
        }

        return $response;
    }
}