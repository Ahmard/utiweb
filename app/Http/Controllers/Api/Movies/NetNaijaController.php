<?php


namespace App\Http\Controllers\Api\Movies;


use App\Http\Controllers\Controller;
use Psr\Http\Message\ServerRequestInterface;
use Uticlass\Video\NetNaija;

class NetNaijaController extends Controller
{
    public function index(ServerRequestInterface $request, array $params)
    {
        sleep(2);
        $movieLink = base64_decode($params['url']);
        $downloadLink = (new NetNaija($movieLink))->get()->linkTwo();

        return response()->json()->success([
            'url' => $downloadLink
        ]);
    }
}