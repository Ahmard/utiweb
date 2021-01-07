<?php


namespace App\Http\Middleware;


use App\Core\Http\Middleware\Middleware;
use App\Statistic;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class VisitCounterMiddleware extends Middleware
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $explodedPath = explode('/', $request->getUri()->getPath());
        Statistic::getInstance($request)->addVisit();
        if (in_array('api', $explodedPath)) {
            return $handler->handle($request);
        }

        return $handler->handle($request);
    }
}