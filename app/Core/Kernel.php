<?php


namespace App\Core;


use App\Core\Http\Middleware\RoutingMiddleware;

class Kernel
{
    public array $routeMiddlewares = [
        RoutingMiddleware::class,
    ];
}