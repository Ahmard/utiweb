<?php

namespace App\Core\Helpers\Classes;


use Exception;
use Psr\Http\Message\ServerRequestInterface;
use QuickRoute\Router\RouteData;

class RequestHelper
{
    protected static ServerRequestInterface $request;

    /**
     * @return ServerRequestInterface
     */
    public static function getRequest(): ServerRequestInterface
    {
        return self::$request;
    }

    /**
     * @param ServerRequestInterface $request
     */
    public static function setRequest(ServerRequestInterface $request): void
    {
        self::$request = $request;
    }

    public function __call(string $methodName, array $arguments): ServerRequestInterface
    {
        if (method_exists(self::$request, $methodName)) {
            return call_user_func_array([self::$request, $methodName], $arguments);
        }

        throw new Exception("Method RequestHelper::{$methodName}() does not exists.");
    }

    public function expectsJson(): bool
    {
        if (
            self::$request->hasHeader('X-Requested-With')
            && strtolower(self::$request->getHeaderLine('X-Requested-With')) == 'xmlhttprequest'
        ) {
            return true;
        }

        return false;
    }

    public function expectsHtml(): bool
    {
        $contentType = self::$request->getHeaderLine('Accept');
        $headers = explode(',', $contentType);
        if (in_array('text/html', $headers)) {
            return true;
        }

        return false;
    }

    public function getDispatchedRoute(): RouteData
    {
        return DataSetter::getDispatchedRoute();
    }

    public function getRouteParameters(): array
    {
        return DataSetter::getRouteParameters();
    }
}