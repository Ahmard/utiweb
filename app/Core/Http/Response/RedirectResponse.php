<?php


namespace App\Core\Http\Response;


final class RedirectResponse extends BaseResponse
{
    public static function create(string $url = '/'): ResponseInterface
    {
        return (new static())->withResponse(
            MultiPurposeResponse::create()
                ->withStatus(302, 'Found')
                ->withHeader('Location', $url)
                ->withJson([
                    'message' => "Redirecting yo to {$url}"
                ])
                ->withView('system/302', [
                    'url' => $url
                ])
        );
    }
}