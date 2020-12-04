<?php


namespace App\Http\Controllers\Api\TVShows;


use App\Core\Http\Response\JsonResponse;
use App\Core\Http\Response\ResponseInterface;
use App\Http\Controllers\Controller;
use Psr\Http\Message\ServerRequestInterface;
use Throwable;
use Uticlass\Video\O2TVSeriesCom;

class O2TvSeriesComController extends Controller
{
    public function index(ServerRequestInterface $request, array $params): ResponseInterface
    {
        $showLink = base64_decode($params['url']);
        try {
            $o2tvseries = O2TVSeriesCom::init($showLink);
            $seasons = $o2tvseries->getLinks();

            $results = [];
            foreach ($seasons as $season) {
                $episodes = $o2tvseries->getEpisodes($season['href']);
                $episodeLinks = [];
                foreach ($episodes as $episode) {
                    $episodeLinks[] = [
                        'name' => $episode['name'],
                        'href' => $episode['href'],
                        'links' => $o2tvseries->getDownloadLinks($episode['href']),
                    ];
                }

                $results[] = [
                    'name' => $season['name'],
                    'href' => $season['href'],
                    'episodes' => $episodeLinks,
                ];
            }
        } catch (Throwable $exception) {
            return JsonResponse::error('An error occurred');
        }

        return JsonResponse::success($results);
    }
}