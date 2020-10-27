<?php

use Psr\Http\Message\ServerRequestInterface;
use QuickRoute\Route;

Route::get('/', function (ServerRequestInterface $request, array $params){
    return $request->getHeaders();
});