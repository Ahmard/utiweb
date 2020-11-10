<?php


namespace App\Core\Http\Router;


use Psr\Http\Message\ServerRequestInterface;
use QuickRoute\Route\Collector;
use QuickRoute\Route\Dispatcher as QuickRouteDispatcher;

class Dispatcher
{
    public static function dispatch(ServerRequestInterface $request)
    {
        $path = $request->getUri()->getPath();
        $method = $request->getMethod();

        $collector = Collector::create()
            ->collectFile(root_path('routes.php'))
            ->cache(storage_path('cache/route'), storage_path('cache/route/definitions.json'))
            ->register();

        return QuickRouteDispatcher::create($collector)->dispatch($method, $path);
    }
}