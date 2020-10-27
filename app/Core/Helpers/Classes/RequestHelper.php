<?php

namespace App\Core\Helpers\Classes;


use Exception;
use Psr\Http\Message\ServerRequestInterface;

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

    public function __call($methodName, $arguments = [])
    {
        if (method_exists(self::$request, $methodName)) {
            return call_user_func_array([self::$request, $methodName], $arguments);
        }

        throw new Exception("Method RequestHelper::{$methodName}() does not exists.");
    }

    public function expectsJson()
    {
        if (
            self::$request->hasHeader('X-Requested-With')
            && self::$request->getHeaderLine('X-Requested-With') == 'XMLHttpRequest'
        ) {
            return true;
        }

        return false;
    }

    public function expectsHtml()
    {
        $contentType = self::$request->getHeaderLine('Accept');
        $headers = explode(',', $contentType);
        if (in_array('text/html', $headers)) {
            return true;
        }

        return false;
    }
}