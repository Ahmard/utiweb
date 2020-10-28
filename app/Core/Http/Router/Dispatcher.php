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
        if (false !== $pos = strpos($path, '?')) {
            $path = substr($path, 0, $pos);
        }
        $path = rawurldecode($path);


        $collector = Collector::create()
            ->collectFile(root_path('routes.php'), [
                'namespace' => 'App\Http\Controllers\\'
            ])
            ->register();

        return QuickRouteDispatcher::create($collector)->dispatch($method, $path);
    }
}