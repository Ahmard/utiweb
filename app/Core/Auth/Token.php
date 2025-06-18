<?php


namespace App\Core\Auth;

use Firebase\JWT\JWT;
use LogicException;
use Throwable;

final class Token
{
    public static function encode(array $user): string
    {
        $user['expiry'] = time() + $_ENV['AUTH_TOKEN_LIFE_TIME'];
        return JWT::encode(
            payload: $user,
            key: file_get_contents(dirname(__DIR__, 3) . '/resources/keys/app-private-key.pem'),
            alg: 'RS256'
        );
    }

    /**
     * @param string $jwtKey
     * @return array|false
     */
    public static function decode(string $jwtKey)
    {
        if (!isset($_ENV['APP_KEY'])) {
            throw new LogicException('An APP_KEY is required to use authentication service.');
        }

        try {
            $decodedToken = (array)JWT::decode(
                $jwtKey,
                $_ENV['APP_KEY'],
                ['HS256']
            );
        } catch (Throwable $exception) {
            handleApplicationException($exception, false);
            return false;
        }

        if (array_key_exists('expiry', $decodedToken)) {
            if ($decodedToken['expiry'] > time()) {
                unset($decodedToken['expiry']);
                return $decodedToken;
            }
        }

        return false;
    }
}