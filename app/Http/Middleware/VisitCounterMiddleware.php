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
        $statistics = Statistic::getInstance($request)->addVisit();
        $response = $handler->handle($request);
        $statistics->saveChanges();

        return $response;
    }
}