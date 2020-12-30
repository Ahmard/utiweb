<?php

namespace App\Core\Helpers\Classes;

use App\Core\Auth\Auth;

class TwigSiteHelper
{
    public string $name;

    public string $title;

    public string $desc;

    public string $keywords;

    public string $authToken;

    public string $adminRoute;

    public RequestHelper $request;


    public function __construct()
    {
        $this->name = $_ENV['APP_NAME'];

        $this->title = $_ENV['APP_TITLE'];

        $this->desc = $_ENV['APP_DESC'];

        $this->keywords = $_ENV['APP_KEYWORDS'];

        $this->authToken = Auth::token();

        $this->adminRoute = $_ENV['ADMIN_ROUTE'];

        $this->request = request();
    }

    public function url(?string $url): string
    {
        return url($url);
    }

    public function adminRoute(string $path = '', bool $willAppendToken = false): string
    {
        $route = $this->adminRoute;
        if ('' !== $path) {
            $route = $this->adminRoute . '/' . $path;
        }

        if ($willAppendToken) {
            $route .= '/' . Auth::token();
        }

        return $route;
    }
}