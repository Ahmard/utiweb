<?php


namespace App\Http\Controllers\Api\Movies;


use App\Core\Http\Response\JsonResponse;
use App\Core\Http\Response\ResponseInterface;
use App\Http\Controllers\Controller;
use Psr\Http\Message\ServerRequestInterface;
use Uticlass\Video\CoolMoviez;

class CoolMoviezController extends Controller
{
    public function index(ServerRequestInterface $request, array $params): ResponseInterface
    {
        $movieLink = base64_decode($params['url']);
        $downloadLink = CoolMoviez::init($movieLink)->get();
        $expName = explode('/', $downloadLink);
        $fileName = end($expName);
        $fileName = explode('-(', $fileName);
        $fileName = current($fileName);

        return JsonResponse::success([
            'name' => $fileName,
            'url' => $downloadLink
        ]);
    }
}