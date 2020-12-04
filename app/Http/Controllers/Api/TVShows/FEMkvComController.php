<?php


namespace App\Http\Controllers\Api\TVShows;


use App\Core\Http\Response\JsonResponse;
use App\Core\Http\Response\ResponseInterface;
use App\Http\Controllers\Controller;
use Psr\Http\Message\ServerRequestInterface;
use Uticlass\Video\FEMkvCom\Main;

class FEMkvComController extends Controller
{
    public function index(ServerRequestInterface $request, array $params): ResponseInterface
    {
        $showLink = base64_decode($params['url']);
        $episodes = Main::init($showLink)->get();

        return JsonResponse::success($episodes);
    }
}