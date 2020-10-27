<?php


namespace App\Core\Http\Router;


use Psr\Http\Message\ServerRequestInterface;
use QuickRoute\Route\Collector;
use WebRoute\Dispatcher as WebRouteDispatcher;

class Dispatcher
{
    public static function dispatch(ServerRequestInterface $request)
    {
        $path = $request->getUri()->getPath();
        $method = $request->getMethod();
        if (false !== $pos = strpos($path, '?')) {
            $uri = substr($path, 0, $pos);
        }
        $path = rawurldecode($path);


        $collector = Collector::create()
            ->collectFile('routes.php')
            ->register();


        return WebRouteDispatcher::create($collector)->dispatch($method, $path);
    }
}