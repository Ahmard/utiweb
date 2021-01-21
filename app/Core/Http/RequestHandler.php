<?php


namespace App\Core\Http;


use App\Core\Http\Response\InternalServerErrorResponse;
use App\Core\Kernel;
use Laminas\Stratigility\MiddlewarePipe;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Throwable;

class RequestHandler
{
    public static function handle(ServerRequestInterface $request): ResponseInterface
    {
        try {
            //Run middlewares
            $middlewares = (new Kernel())->routeMiddlewares;
            $middlewareRunner = new MiddlewarePipe();
            foreach ($middlewares as $middleware) {
                $middlewareRunner->pipe(new $middleware);
            }
            $response = $middlewareRunner->handle($request);

            if ($response instanceof Throwable) {
                handleApplicationException($response);
            }
        } catch (Throwable $throwable) {
            handleApplicationException($throwable);
        }

        if (!isset($response)) {
            $response = InternalServerErrorResponse::create();
        }

        return $response;
    }
}