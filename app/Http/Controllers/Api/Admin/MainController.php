<?php


namespace App\Http\Controllers\Api\Admin;


use App\Core\Database;
use App\Core\Http\Response\JsonResponse;
use App\Core\Http\Response\ResponseInterface;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    public function deleteStatistics(): ResponseInterface
    {
        Database::create()->exec('DELETE FROM statistics');

        return JsonResponse::success([
            'message' => 'Statistics deleted successfully.'
        ]);
    }
}