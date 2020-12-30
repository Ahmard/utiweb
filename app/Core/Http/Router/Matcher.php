<?php


namespace App\Core\Http\Router;


use App\Core\Auth\Auth;
use App\Core\Helpers\Classes\FormHelper;
use App\Core\Http\Response;
use App\Core\Http\Response\InternalServerErrorResponse;
use App\Kernel;
use Exception;
use Laminas\Stratigility\MiddlewarePipe;
use Psr\Http\Message\ServerRequestInterface;
use QuickRoute\Route\DispatchResult;
use Throwable;
use function Laminas\Stratigility\middleware;
use Psr\Http\Message\ResponseInterface;

class Matcher
{
    public static function match(ServerRequestInterface $request, DispatchResult $dispatchResult): ResponseInterface
    {
        //Initialise authentication class
        Auth::handle($dispatchResult->getUrlParameters()['token'] ?? '');

        //Run middleware
        $routeMiddlewares = $dispatchResult->getRoute()->getMiddleware();
        if ($routeMiddlewares) {
            $middlewares = explode('|', $routeMiddlewares);
            $kernelMiddlewares = (new Kernel())->routeMiddlewares;
            $middlewareRunner = new MiddlewarePipe();
            foreach ($middlewares as $middleware) {
                if ($middleware) {
                    $definedMiddleware = $kernelMiddlewares[$middleware] ?? null;
                    if ($definedMiddleware) {
                        $middlewareRunner->pipe(new $definedMiddleware());
                    }
                }
            }

            //Register our controller call as middleware
            $middlewareRunner->pipe(middleware(function () use ($request, $dispatchResult) {
                return Matcher::route($request, $dispatchResult);
            }));

            return $middlewareRunner->handle($request);
        }

        return Matcher::route($request, $dispatchResult);
    }

    private static function route(ServerRequestInterface $request, DispatchResult $dispatchResult): ResponseInterface
    {
        $routeData = $dispatchResult->getRoute();
        $requestParams = $dispatchResult->getUrlParameters();

        //Handle controller
        $controller = $routeData->getHandler();
        if (is_callable($controller)) {
            return call_user_func($controller, $request, $requestParams);
        }

        $explodedController = explode('@', $controller);
        $controllerClass = $explodedController[0];
        $controllerMethod = $explodedController[1];

        $namespacedController = $_ENV['CONTROLLER_NAMESPACE'] . $routeData->getNamespace() . $controllerClass;

        //Initialize form helpers
        FormHelper::setRequest($request);

        //Call defined method
        $instantiatedController = (new $namespacedController());

        if (!method_exists($instantiatedController, $controllerMethod)) {
            throw new Exception("Method {$namespacedController}::{$controllerMethod}() does not exists.");
        }

        $response = InternalServerErrorResponse::create();

        try {
            $response = call_user_func(
                [
                    $instantiatedController,
                    $controllerMethod
                ],
                $request,
                $requestParams
            );
        } catch (Throwable $exception) {
            handleApplicationException($exception);
        }

        return $response;
    }
}