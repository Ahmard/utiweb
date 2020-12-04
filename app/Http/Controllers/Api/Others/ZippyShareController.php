<?php


namespace App\Http\Controllers\Api\Others;


use App\Core\Http\Response\JsonResponse;
use App\Core\Http\Response\ResponseInterface;
use App\Http\Controllers\Controller;
use Psr\Http\Message\ServerRequestInterface;
use Uticlass\Others\ZippyShare;

class ZippyShareController extends Controller
{
    public function index(ServerRequestInterface $request, array $params): ResponseInterface
    {
        $zippyUrl = base64_decode($params['url']);
        $fileLink = ZippyShare::init($zippyUrl)->get();
        $expName = explode('/', $fileLink);
        $fileName = end($expName);

        return JsonResponse::success([
            'name' => $fileName,
            'url' => $fileLink
        ]);
    }
}