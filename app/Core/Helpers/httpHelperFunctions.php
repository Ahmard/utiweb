<?php

use App\Core\Helpers\Classes\FormHelper;
use App\Core\Helpers\Classes\RequestHelper;
use App\Core\Http\Response;
Use App\Core\Http\Response\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * HTTP Response helper
 * @param int $statusCode
 * @return Response
 */
function response(int $statusCode = 200)
{
    return new Response($statusCode);
}

/**
 * Send http response with source file content
 * @param string $viewPath
 * @param array $data
 * @return \App\Core\ResponseGenerator
 */
function view(string $viewPath, array $data = [])
{
    return response()->view($viewPath, $data);
}

/**
 * Redirect to new url
 * @param string $url
 * @return \React\Http\Message\Response
 */
function redirect(string $url){
    return \response()->redirect($url);
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