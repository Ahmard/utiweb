<?php


namespace App\Http\Controllers\Api\TVShows;


use App\Core\Http\Response\JsonResponse;
use App\Core\Http\Response\ResponseInterface;
use App\Http\Controllers\Controller;
use App\Url;
use Guzwrap\Request;
use Uticlass\Video\MobileTvShows;

class MobileTVShowsController extends Controller
{
    public function index(): ResponseInterface
    {
        $request = Request::getInstance()->withCookie();

        //Get number of seasons
        $seasons = MobileTvShows::create()
            ->useRequest($request)
            ->getSeasons(Url::getParamUrl());

        foreach ($seasons as &$season) {
            //Get total episodes on season
            $episodes = MobileTvShows::create()
                ->useRequest($request)
                ->getEpisodes($season['href']);

            foreach ($episodes as &$episode) {
                //Get stream/download page url
                $firstEpisodeLinks = MobileTvShows::create()
                    ->useRequest($request)
                    ->getEpisodeLinks($episode['links'][0]['href']);

                $secondEpisodeLinks = MobileTvShows::create()
                    ->useRequest($request)
                    ->getEpisodeLinks($episode['links'][1]['href']);

                //Get actual file url
                if (false !== strstr($firstEpisodeLinks['download'], 'download')) {
                    $firstEpisodeLinks['links']['file_url'] = MobileTvShows::create()
                        ->useRequest($request)
                        ->getDownloadLinks($firstEpisodeLinks['download']);
                }

                if (false !== strstr($secondEpisodeLinks['download'], 'download')) {
                    $secondEpisodeLinks['links']['file_url'] = MobileTvShows::create()
                        ->useRequest($request)
                        ->getDownloadLinks($secondEpisodeLinks['download']);
                }

                $episode['links'][0]['links'] = $firstEpisodeLinks;
                $episode['links'][1]['links'] = $secondEpisodeLinks;

            }

            $season['episodes'] = $episodes;
        }

        return JsonResponse::success($seasons);
    }
}