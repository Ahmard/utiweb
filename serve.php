<?php

use PHPServer\BuiltIn\Server;

require 'vendor/autoload.php';

Server::create('127.0.0.1', 8181)
    ->setRouterScript(__DIR__ . '/public/index.php')
    ->setDocumentRoot(__DIR__ . '/public')
    ->start()
    ->logOutputToConsole();