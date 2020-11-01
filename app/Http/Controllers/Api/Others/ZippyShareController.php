<?php


namespace App\Http\Controllers\Api\Others;


use App\Http\Controllers\Controller;
use Psr\Http\Message\ServerRequestInterface;
use Uticlass\Others\ZippyShare;

class ZippyShareController extends Controller
{
    public function index(ServerRequestInterface $request, array $params)
    {
        $zippyUrl = base64_decode($params['url']);
        $fileLink = ZippyShare::init($zippyUrl)->get();
        $expName = explode('/', $fileLink);
        $fileName = end($expName);

        return response()->json()->success([
            'name' => $fileName,
            'url' => $fileLink
        ]);
    }
}