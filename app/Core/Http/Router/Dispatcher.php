<?php


namespace App\Core\Http\Router;


use Psr\Http\Message\ServerRequestInterface;
use QuickRoute\Router\Dispatcher as QuickRouteDispatcher;
use QuickRoute\Router\Collector;
use QuickRoute\Router\DispatchResult;

class Dispatcher
{
    private static DispatchResult $dispatchResult;

    public static function dispatch(ServerRequestInterface $request): DispatchResult
    {
        $path = $request->getUri()->getPath();
        $method = $request->getMethod();

        $collector = Collector::create()
            ->collectFile(storage_path('routes/web.php'))
            ->collectFile(storage_path('routes/api.php'), [
                'prefix' => 'api',
                'namespace' => 'Api\\',
            ]);

        if ('production' == $_ENV['APP_ENVIRONMENT']) {
            $collector->cache(storage_path('cache/routes.php'));
        }

        $collector->register();

        return self::$dispatchResult =
            QuickRouteDispatcher::create($collector)
                ->dispatch($method, $path);
    }

    /**
     * @return DispatchResult
     */
    public static function getDispatchResult(): DispatchResult
    {
        return self::$dispatchResult;
    }
}