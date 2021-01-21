<?php


namespace App\Core\Helpers\Classes;


use Psr\Http\Message\ServerRequestInterface;
use QuickRoute\Route\RouteData;

class DataSetter
{
    private static ServerRequestInterface $request;
    private static array $routeParameters;
    private static RouteData $dispatchedRoute;

    public static function getRouteParameters(): array
    {
        return self::$routeParameters;
    }

    public static function setRouteParameters(array $routeParameters): void
    {
        self::$routeParameters = $routeParameters;
    }

    public static function getRequest(): ServerRequestInterface
    {
        return self::$request;
    }

    public static function setRequest(ServerRequestInterface $request): void
    {
        self::$request = $request;
    }

    public static function getDispatchedRoute(): RouteData
    {
        return self::$dispatchedRoute;
    }

    public static function setDispatchedRoute(RouteData $dispatchedRoute): void
    {
        self::$dispatchedRoute = $dispatchedRoute;
    }
}