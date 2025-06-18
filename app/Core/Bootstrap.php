<?php

namespace App\Core;

use Exception;

class Bootstrap
{
    /**
     * @return void
     * @throws Exception
     */
    public static function performInitialChecks(): void
    {
        $publicKey = dirname(__DIR__, 2) . '/resources/keys/app-public-key.pem';
        $privateKey = dirname(__DIR__, 2) . '/resources/keys/app-private-key.pem';

        if (!file_exists($publicKey) || !file_exists($privateKey)) {
            throw new Exception('Please provide a valid public and private key pair');
        }
    }
}