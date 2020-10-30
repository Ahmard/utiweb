<?php


namespace App\Core\Http\Router;


use App\Core\Helpers\Classes\FormHelper;
use Exception;
use Psr\Http\Message\ServerRequestInterface;
use QuickRoute\Route\DispatchResult;

class Matcher
{
    public static function match(ServerRequestInterface $request, DispatchResult $dispatchResult)
    {
        $routeData = $dispatchResult->getRoute();

        $requestParams = $dispatchResult->getUrlParameters();
        //Handle controller
        $controller = $routeData['controller'];
        if (is_callable($controller)) {
            return call_user_func($controller, $request, $requestParams);
        }

        $explodedController = explode('@', $controller);
        $controllerClass = $explodedController[0];
        $controllerMethod = $explodedController[1];

        $namespacedController = $_ENV['CONTROLLER_NAMESPACE'] . $routeData['namespace'] . $controllerClass;

        //Initialize form helpers
        FormHelper::setRequest($request);

        //Call defined method
        $instantiatedController = (new $namespacedController());

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