<?php


namespace App\Core\Http\Response;


final class NotFoundResponse extends BaseResponse
{
    public static function create(): ResponseInterface
    {
        return (new static())->withResponse(
            MultiPurposeResponse::create()
                ->withStatus(404, 'resources not found.')
                ->withJson([
                    'status' => false,
                    'message' => 'The resources you are looking does not exists.'
                ])
                ->withView('system/404')
        );
    }
}