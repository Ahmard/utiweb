<?php


namespace App\Core\Http\Response;


final class MethodNotAllowedResponse extends BaseResponse
{
    public static function create(): ResponseInterface
    {
        return (new static())->withResponse(
            MultiPurposeResponse::create()
                ->withStatus(405, 'method not allowed')
                ->withJson([
                    'message' => 'Request method not allowed.'
                ])
                ->withView('system/405')
        );
    }
}