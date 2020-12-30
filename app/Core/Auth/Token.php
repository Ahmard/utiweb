<?php


namespace App\Core\Auth;

use Firebase\JWT\JWT;
use Throwable;

final class Token
{
    public static function encode(array $user): string
    {
        $user['expiry'] = time() + $_ENV['AUTH_TOKEN_LIFE_TIME'];
        return JWT::encode($user, $_ENV['APP_KEY'] ?? uniqid());
    }

    /**
     * @param string $jwtKey
     * @return array|false
     */
    public static function decode(string $jwtKey)
    {
        try {
            $decodedToken = (array)JWT::decode(
                $jwtKey,
                $_ENV['APP_KEY'] ?? 'ahmard',
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