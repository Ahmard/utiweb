<?php


namespace App;


use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\VisitCounterMiddleware;

class Kernel
{
    public array $middlewares = [
        VisitCounterMiddleware::class,
    ];

    public array $routeMiddlewares = [
        'admin' => AuthMiddleware::class,
    ];
}