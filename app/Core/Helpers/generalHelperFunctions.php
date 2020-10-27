<?php

use App\Core\Helpers\Classes\ValidationHelper;

$root = dirname(__DIR__, 3);
$slash = DIRECTORY_SEPARATOR;

function url($url = null)
{
    global $serverConfig;
    return "http://{$serverConfig['host']}:{$serverConfig['port']}/{$url}";
}

/**
 * Root directory path
 * @param null $path
 * @return string
 */
function root_path($path = null)
{
    global $root, $slash;
    return "{$root}{$slash}{$path}";
}


/**
 * Application directory path
 * @param null $path
 * @return string
 */
function app_path($path = null)
{
    global $root, $slash;
    return "{$root}{$slash}app{$slash}{$path}";
}

/**
 * Application view directory path
 * @param null $path
 * @return string
 */
function view_path($path = null)
{
    global $root, $slash;
    return "{$root}{$slash}resources{$slash}views{$slash}{$path}";
}

/**
 * Storage directory path
 * @param null $path
 * @return string
 */
function storage_path($path = null)
{
    global $root, $slash;
    return "{$root}{$slash}storage{$slash}{$path}";
}

/**
 * Controllers path
 * @param null $path
 * @return string
 */
function controller_path($path = null)
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
function validator()
{
    return new ValidationHelper();
}