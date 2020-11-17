<?php


namespace App\Http\Controllers\Api\Admin;


use App\Http\Controllers\Controller;
use Psr\Http\Message\ServerRequestInterface;

class ErrorController extends Controller
{
    public function delete(ServerRequestInterface $request)
    {
        $errorLogPath = storage_path('logs/error/') . $request->getQueryParams()['name'];
        if (file_exists($errorLogPath)) {
            unlink($errorLogPath);
        }

        return response()->json()->success([
            'message' => 'Error log has been deleted.'
        ]);
    }
}