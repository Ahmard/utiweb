<?php


namespace App\Http\Controllers\Api;


use App\Core\Http\Response\JsonResponse;
use App\Core\Http\Response\ResponseInterface;
use App\Http\Controllers\Controller;
use Psr\Http\Message\ServerRequestInterface;
use Uticlass\Video\Search\FEMKVComSearch;
use Uticlass\Video\Search\FZMoviesSearch;
use Uticlass\Video\Search\MobileTVShowsSearch;
use Uticlass\Video\Search\NetNaijaSearch;

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

    public function mobiletvshows(ServerRequestInterface $request): ResponseInterface
    {
        $params = $request->getQueryParams();
        $results = MobileTVShowsSearch::create()
            ->search($params['q'])
            ->searchBy($params['by'])
            ->get($params['page_number'] ?? 1);

        return JsonResponse::success($results);
    }

    public function netnaija(ServerRequestInterface $request): ResponseInterface
    {
        $params = $request->getQueryParams();
        $results = NetNaijaSearch::create()
            ->search($params['q'])
            ->category($params['category'] ?? '')
            ->get($params['page_number'] ?? 1);

        return JsonResponse::success($results);
    }
}