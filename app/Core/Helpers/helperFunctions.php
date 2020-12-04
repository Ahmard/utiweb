<?php

use App\Core\Helpers\Classes\FormHelper;
use App\Core\Helpers\Classes\RequestHelper;
use App\Core\Helpers\Classes\ValidationHelper;
use App\Core\Http\Response;
use App\Core\Http\Response\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

$root = dirname(__DIR__, 3);
$slash = DIRECTORY_SEPARATOR;

function url($url = null): string
{
    return "{$_ENV['APP_URL']}/{$url}";
}

/**
 * Root directory path
 * @param null $path
 * @return string
 */
function root_path($path = null): string
{
    global $root, $slash;
    return "{$root}{$slash}{$path}";
}


/**
 * Application directory path
 * @param null $path
 * @return string
 */
function app_path($path = null): string
{
    global $root, $slash;
    return "{$root}{$slash}app{$slash}{$path}";
}

/**
 * Application view directory path
 * @param null $path
 * @return string
 */
function view_path($path = null): string
{
    global $root, $slash;
    return "{$root}{$slash}resources{$slash}views{$slash}{$path}";
}

/**
 * Storage directory path
 * @param null $path
 * @return string
 */
function storage_path($path = null): string
{
    global $root, $slash;
    return "{$root}{$slash}storage{$slash}{$path}";
}

/**
 * Controllers path
 * @param null $path
 * @return string
 */
function controller_path($path = null): string
{
    global $root, $slash;
    return "{$root}{$slash}app{$slash}Http{$slash}Controllers{$slash}{$path}";
}

$loadedConfig = [];
function config(string $file)
{
    global $slash, $loadedConfig;
    if (array_key_exists($file, $loadedConfig)) {
        return $loadedConfig[$file];
    }

    $loaded = require root_path("config{$slash}{$file}.php");
    return $loadedConfig[$file] = $loaded;
}

/**
 * Input validation helper
 * @return ValidationHelper
 */
function validator(): ValidationHelper
{
    return new ValidationHelper();
}


/**
 * HTTP Response helper
 * @return Response
 */
function response(): Response
{
    return new Response();
}

/**
 * Send http response with source file content
 * @param string $viewPath
 * @param array $data
 * @return ResponseInterface
 */
function view(string $viewPath, array $data = []): ResponseInterface
{
    return response()->view($viewPath, $data);
}

/**
 * Redirect to new url
 * @param string $url
 * @return ResponseInterface
 */
function redirect(string $url): ResponseInterface
{
    return response()->redirect($url);
}

function old(string $key)
{
    return FormHelper::getOldData($key);
}

function form_error(string $key)
{
    return FormHelper::getFormError($key);
}

/**
 * Request helper
 * @return ServerRequestInterface|RequestHelper
 */
function request()
{
    return new RequestHelper();
}