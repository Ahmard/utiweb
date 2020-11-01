<?php


namespace App\Http\Controllers\Api\Movies;


use App\Http\Controllers\Controller;
use Psr\Http\Message\ServerRequestInterface;
use Uticlass\Video\FZMovies;

class FZMoviesController extends Controller
{
    public function index(ServerRequestInterface $request, array $params)
    {
        $movieLink = base64_decode($params['url']);
        $chosenLink = $params['chosen'] ?? 1;

        $downloadLink = FZMovies::init($movieLink)->get($chosenLink);
        $expName = explode('/', $downloadLink);
        $fileName = end($expName);
        $fileName = explode('(fzmovies.net)', $fileName);
        $fileName = substr(current($fileName), 0, -1);

        return response()->json()->success([
            'name' => $fileName,
            'url' => $downloadLink
        ]);
    }
}