<?php


namespace App\Http\Middleware;


use App\Core\Auth\Auth;
use App\Core\Http\Middleware\Middleware;
use App\Core\Http\Response\MultiPurposeResponse;
use App\Core\Http\Response\RedirectResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AuthMiddleware extends Middleware
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if (Auth::check()) {
            return $handler->handle($request);
        }

        return RedirectResponse::create('/');
    }
}