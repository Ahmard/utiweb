<?php


namespace App\Http\Controllers\Api\TVShows;


use App\Http\Controllers\Controller;
use Psr\Http\Message\ServerRequestInterface;
use Throwable;
use Uticlass\Video\O2TVSeriesCoZa;

class O2TvSeriesCoZaController extends Controller
{
    public function index(ServerRequestInterface $request, array $params)
    {
        $showLink = base64_decode($params['url']);
        try {
            $o2tvseries = O2TVSeriesCoZa::init($showLink);
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
            return response()->json()->error('An error occurred');
        }

        return response()->json()->success($results);
    }
}