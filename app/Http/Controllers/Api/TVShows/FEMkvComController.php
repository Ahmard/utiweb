<?php


namespace App\Http\Controllers\Api\TVShows;


use App\Http\Controllers\Controller;
use Psr\Http\Message\ServerRequestInterface;
use Uticlass\Video\FEMkvCom\Main;

class FEMkvComController extends Controller
{
    public function index(ServerRequestInterface $request, array $params)
    {
        $showLink = base64_decode($params['url']);
        $episodes = [
            [
                'name' => 'Episode 1',
                'url' => 'http://episode.com'
            ],
            [
                'name' => 'Episode 2',
                'url' => 'http://episode.com'
            ],
            [
                'name' => 'Episode 3',
                'url' => 'http://episode.com'
            ],
            [
                'name' => 'Episode 4',
                'url' => 'http://episode.com'
            ],
        ];
        (new Main($showLink))->get(function ($eps) use (&$episodes){
            $episodes = $eps;
        });

        return response()->json()->success($episodes);
    }
}