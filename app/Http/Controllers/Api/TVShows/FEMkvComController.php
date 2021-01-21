<?php


namespace App\Http\Controllers\Api\TVShows;


use App\Core\Http\Response\JsonResponse;
use App\Core\Http\Response\ResponseInterface;
use App\Http\Controllers\Controller;
use App\Url;
use Psr\Http\Message\ServerRequestInterface;
use Uticlass\Video\FEMkvCom\Main;

class FEMkvComController extends Controller
{
    public function index(ServerRequestInterface $request, array $params): ResponseInterface
    {
        $episodes = Main::init(Url::getParamUrl())->get();

        return JsonResponse::success($episodes);
    }
}