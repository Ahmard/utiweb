<?php


namespace App\Http\Controllers\Api\Others;


use App\Core\Http\Response\JsonResponse;
use App\Core\Http\Response\ResponseInterface;
use App\Http\Controllers\Controller;
use App\Url;
use Psr\Http\Message\ServerRequestInterface;
use Uticlass\Others\ZippyShare;

class ZippyShareController extends Controller
{
    public function index(): ResponseInterface
    {
        $fileLink = ZippyShare::init(Url::getParamUrl())->get();
        $expName = explode('/', $fileLink);
        $fileName = end($expName);

        return JsonResponse::success([
            'name' => $fileName,
            'url' => $fileLink
        ]);
    }
}