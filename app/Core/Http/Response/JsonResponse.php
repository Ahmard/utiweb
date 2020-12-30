<?php


namespace App\Core\Http\Response;


use Psr\Http\Message\StreamInterface;
use Throwable;

final class JsonResponse extends BaseResponse
{
    /**
     * @param array|object $body
     * @return ResponseInterface
     */
    public static function create($body = []): ResponseInterface
    {
        return (new JsonResponse())->withJson($body)
            ->withAddedHeader('Content-Type', 'application/json');
    }

    /**
     * Respond with success response
     * @param array|object $data An array or object
     * @return ResponseInterface
     */
    public static function success($data): ResponseInterface
    {
        return JsonResponse::create([
            'success' => true,
            'data' => $data
        ]);
    }

    /**
     * @param array|object $body
     * @return ResponseInterface
     */
    public function withBody($body = []): ResponseInterface
    {
        return $this->withJson($body);
    }

    /**
     * Respond with error response
     * @param array|string|Throwable $errorData An error message
     * @return ResponseInterface
     */
    public static function error($errorData): ResponseInterface
    {
        return JsonResponse::create([
            'success' => false,
            'error' => $errorData
        ]);
    }

    public function getBody(): StreamInterface
    {
        //This method will be recursively called,
        //so we need to know when to quit.
        static $willReturn = false;
        if ($willReturn) {
            return parent::getBody();
        }

        $willReturn = true;
        return $this->writeBodyStream($this->getJson())->getBody();
    }
}