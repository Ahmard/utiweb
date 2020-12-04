<?php


namespace App;


use App\Core\Http\Router\Dispatcher;

class Url
{
    /**
     * Get url passed in routing parameters
     * @return false|string
     */
    public static function getParamUrl()
    {
        $parameters = Dispatcher::getDispatchResult()->getUrlParameters();
        return base64_decode($parameters['url']);
    }

    /**
     * Check if url passed to routing parameters is valid
     * @return bool
     */
    public static function isValidParamUrl()
    {
        return filter_var(self::getParamUrl(), FILTER_VALIDATE_URL) ? true : false;
    }
}