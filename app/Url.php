<?php


namespace App;


use App\Core\Http\Router\Dispatcher;
use LogicException;

class Url
{
    /**
     * Check if url passed to routing parameters is valid
     * @return bool
     */
    public static function isParamUrlValid(): bool
    {
        return self::isUrlValid(self::getParamUrl());
    }

    /**
     * Check if url is valid
     * @param string $url
     * @return bool
     */
    public static function isUrlValid(string $url): bool
    {
        return filter_var($url, FILTER_VALIDATE_URL) ? true : false;
    }

    /**
     * Get url passed in routing parameters
     * @return string
     */
    public static function getParamUrl(): string
    {
        $parameters = Dispatcher::getDispatchResult()->getUrlParameters();
        $url = base64_decode($parameters['url']);
        if (!self::isUrlValid($url)) {
            throw new LogicException('Parameter url is invalid');
        }

        return $url;
    }
}