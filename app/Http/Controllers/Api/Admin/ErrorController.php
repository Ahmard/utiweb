<?php


namespace App\Http\Controllers\Api\Admin;


use App\Core\Http\Response\JsonResponse;
use App\Core\Http\Response\ResponseInterface;
use App\Http\Controllers\Controller;
use DirectoryIterator;
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

    public function deleteAll(ServerRequestInterface $request): ResponseInterface
    {
        $dirIterator = new DirectoryIterator(storage_path('logs/error/'));
        foreach ($dirIterator as $file) {
            if ($file->isFile()) {
                unlink($file->getRealPath());
            }
        }

        return JsonResponse::success([
            'message' => 'Error logs has been deleted.'
        ]);
    }
}