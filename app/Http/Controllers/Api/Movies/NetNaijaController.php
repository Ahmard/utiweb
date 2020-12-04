<?php


namespace App\Http\Controllers\Api\Movies;


use App\Core\Http\Response\JsonResponse;
use App\Core\Http\Response\ResponseInterface;
use App\Http\Controllers\Controller;
use Psr\Http\Message\ServerRequestInterface;
use Uticlass\Video\NetNaija;

class NetNaijaController extends Controller
{
    public function index(ServerRequestInterface $request, array $params): ResponseInterface
    {
        $movieLink = base64_decode($params['url']);
        $downloadLink = NetNaija::init($movieLink)->get()->linkTwo();
        $expName = explode('/', $downloadLink);
        $fileName = end($expName);
        $fileName = explode('netnaija', $fileName);
        $fileName = current($fileName);

        return JsonResponse::success([
            'name' => $fileName,
            'url' => $downloadLink
        ]);
    }
}