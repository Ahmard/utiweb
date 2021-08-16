<?php


namespace App\Http\Controllers\Api\Movies;


use App\Core\Http\Response\JsonResponse;
use App\Core\Http\Response\ResponseInterface;
use App\Http\Controllers\Controller;
use App\Url;
use Uticlass\Video\NetNaija;

class NetNaijaController extends Controller
{
    public function index(): ResponseInterface
    {
        $url = Url::getParamUrl();
        if (!NetNaija::isVideoUrl($url)) {
            return JsonResponse::error('The provided url is not valid video url, please check and try again.');
        }

        $downloadLink = NetNaija::init($url)->get();
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