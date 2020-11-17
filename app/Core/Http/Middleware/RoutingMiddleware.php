<?php


namespace App\Core\Http\Middleware;


use App\Core\Http\Response\PlainResponse;
use App\Core\Http\Router\Dispatcher;
use App\Core\Http\Router\Matcher;
use App\Kernel;
use Laminas\Stratigility\MiddlewarePipe;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Throwable;
use function Laminas\Stratigility\middleware;

class RoutingMiddleware extends Middleware
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        //Dispatch http request
        $dispatchResult = Dispatcher::dispatch($request);

        switch (true) {
            case $dispatchResult->isFound():
                //Run http middlewares defined in App\Kernel
                $middlewareRunner = new MiddlewarePipe();
                $middlewares = (new Kernel())->middlewares;
                foreach ($middlewares as $middleware) {
                    $middlewareRunner->pipe(new $middleware());
                }

                //Register our controller call as middleware
                $middlewareRunner->pipe(middleware(function () use ($request, $dispatchResult) {
                    try {
                        $response = Matcher::match($request, $dispatchResult);
                        if (empty($response)) {
                            $response = PlainResponse::create();
                        }
                    } catch (Throwable $exception) {
                        $response = response()->internalServerError($exception);
                    }

                    return $response;
                }));

                //Run middlewares
                $response = $middlewareRunner->handle($request);
                break;
            case $dispatchResult->isNotFound():
                $response = response()->notFound();
                break;
            case $dispatchResult->isMethodNotAllowed():
                $response = response()->methodNotAllowed();
                break;
            default:
                $response = response()->internalServerError();
        }

        return $response;
    }
}