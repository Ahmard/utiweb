<?php


namespace App\Http\Middleware;


use App\Core\Http\Middleware\Middleware;
use App\Core\Http\Response\JsonResponse;
use App\Url;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ValidateRouteUrlParam extends Middleware
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if (!Url::isValidParamUrl()) {
            return JsonResponse::error('The provided url is invalid, check your url and try again.');
        }

        return parent::process($request, $handler);
    }
}