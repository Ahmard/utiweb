<?php


namespace App\Http\Controllers\Api\Movies;


use App\Core\Helpers\Classes\DataSetter;
use App\Core\Http\Response\JsonResponse;
use App\Core\Http\Response\ResponseInterface;
use App\Http\Controllers\Controller;
use App\Url;
use Psr\Http\Message\ServerRequestInterface;
use Uticlass\Video\FZMovies;

class FZMoviesController extends Controller
{
    public function index(): ResponseInterface
    {
        $chosenLink = DataSetter::getRouteParameters()['chosen'] ?? 1;

        $downloadLink = FZMovies::init(Url::getParamUrl())->get($chosenLink);
        $expName = explode('/', $downloadLink);
        $fileName = end($expName);
        $fileName = explode('(fzmovies.net)', $fileName);
        $fileName = substr(current($fileName), 0, -1);

        return JsonResponse::success([
            'name' => $fileName,
            'url' => $downloadLink
        ]);
    }
}