<?php


namespace App\Http\Controllers\Api\Admin;


use App\Core\Http\Response\JsonResponse;
use App\Core\Http\Response\ResponseInterface;
use App\Http\Controllers\Controller;
use Psr\Http\Message\ServerRequestInterface;

class ErrorController extends Controller
{
    public function delete(ServerRequestInterface $request): ResponseInterface
    {
        $errorLogPath = storage_path('logs/error/') . $request->getQueryParams()['name'];
        if (file_exists($errorLogPath)) {
            unlink($errorLogPath);
        }

        return JsonResponse::success([
            'message' => 'Error log has been deleted.'
        ]);
    }
}