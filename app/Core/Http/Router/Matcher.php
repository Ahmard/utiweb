<?php


namespace App\Core\Http\Router;


use Exception;
use Psr\Http\Message\ServerRequestInterface;
use WebRoute\DispatchResult;

class Matcher
{
    public static function match(ServerRequestInterface $request, DispatchResult $dispatchResult)
    {
        $routeData = $dispatchResult->getRoute()->getRouteData();
        $requestParams = $dispatchResult->getUrlParameters();
        //Handle controller
        $controller = $routeData['controller'];
        if (is_callable($controller)) {
            return call_user_func($controller, $request, $requestParams);
        }

        $explodedController = explode('@', $controller);
        $controllerClass = $explodedController[0];
        $controllerMethod = $explodedController[1];

        $namespacedController = $routeData['namespace'] . $controllerClass;

        //Initialize form helpers
        //FormHelper::setRequest($request);

        //Call defined method
        $instantiatedController = (new $namespacedController())->_initAndFeed_([
            'request' => $request,
            'params' => $requestParams
        ]);

        if (!method_exists($instantiatedController, $controllerMethod)) {
            return new Exception("Method {$namespacedController}::{$controllerMethod}() does not exists.");
        }

        $response = call_user_func(
            [
                $instantiatedController,
                $controllerMethod
            ],
            $request,
            $requestParams
        );

        return $response;
    }
}