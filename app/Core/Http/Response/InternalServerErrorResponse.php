<?php


namespace App\Core\Http\Response;


use App\Core\Error;

final class InternalServerErrorResponse extends BaseResponse
{
    public static function create($exception = null): ResponseInterface
    {
        $error = Error::create($exception)->getMessage() ?? 'Internal server error.';
        return (new static())->withResponse(
            MultiPurposeResponse::create()
                ->withStatus(500, 'internal server error.')
                ->withJson([
                    'status' => false,
                    'message' => $error
                ])
                ->withView('system/500', [
                    'exception' => $error
                ])
        );
    }
}