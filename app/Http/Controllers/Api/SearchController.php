<?php


namespace App\Http\Controllers\Api;


use App\Core\Http\Response\JsonResponse;
use App\Core\Http\Response\ResponseInterface;
use App\Http\Controllers\Controller;
use Psr\Http\Message\ServerRequestInterface;
use Uticlass\Video\Search\FEMKVComSearch;
use Uticlass\Video\Search\FZMoviesSearch;

class SearchController extends Controller
{
    public function fzmovies(ServerRequestInterface $request): ResponseInterface
    {
        $params = $request->getQueryParams();
        $results = FZMoviesSearch::create()
            ->search($params['q'])
            ->searchBy($params['by'])
            ->searchIn($params['in'])
            ->get($params['page_number'] ?? 1);

        return JsonResponse::success($results);
    }

    public function femkvcom(ServerRequestInterface $request): ResponseInterface
    {
        $params = $request->getQueryParams();
        $results = FEMKVComSearch::create()
            ->search($params['q'])
            ->get($params['page_number'] ?? 1);

        return JsonResponse::success($results);
    }
}