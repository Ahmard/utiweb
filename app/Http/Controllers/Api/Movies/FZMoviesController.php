<?php


namespace App\Http\Controllers\Api\Movies;


use App\Http\Controllers\Controller;
use Psr\Http\Message\ServerRequestInterface;
use Uticlass\Video\FZMovies;

class FZMoviesController extends Controller
{
    public function index(ServerRequestInterface $request, array $params)
    {
        sleep(2);
        $movieLink = base64_decode($params['url']);
        $downloadLink = (new FZMovies($movieLink))->get();
        return response()->json()->success([
            'url' => $downloadLink
        ]);
    }
}