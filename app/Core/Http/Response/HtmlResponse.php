<?php


namespace App\Core\Http\Response;


/**
 * Class HtmlResponse
 * @package App\Core\Http\Response
 */
final class HtmlResponse extends BaseResponse
{
    public static function create(string $body = ''): ResponseInterface
    {
        return (new static())->writeBodyStream($body)
            ->withHeader('Content-Type', 'text/html');
    }
}