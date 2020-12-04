<?php


namespace App\Http\Controllers\Api\Admin;


use App\Core\Database;
use App\Core\Http\Response\JsonResponse;
use App\Core\Http\Response\ResponseInterface;
use App\Http\Controllers\Controller;
use App\Notification;
use Psr\Http\Message\ServerRequestInterface;

class NotificationController extends Controller
{
    public function create(ServerRequestInterface $request): ResponseInterface
    {
        $lastInsertId = Notification::create($request);

        return JsonResponse::success([
            'message' => 'Notification saved successfully.',
            'id' => $lastInsertId,
        ]);
    }

    public static function view(ServerRequestInterface $request, array $params): ResponseInterface
    {
        return JsonResponse::success(Notification::get($params['id']));
    }

    public function update(ServerRequestInterface $request, array $params): ResponseInterface
    {
        Notification::update($request, $params['id']);

        return JsonResponse::success([
            'message' => 'Notification has been updated.',
            'note' => $request->getParsedBody()
        ]);
    }

    public function delete(ServerRequestInterface $request, array $params): ResponseInterface
    {
        Notification::delete($params['id']);

        return JsonResponse::success([
            'message' => 'Notification has been deleted.'
        ]);
    }
}