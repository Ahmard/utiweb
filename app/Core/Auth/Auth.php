<?php


namespace App\Core\Auth;

final class Auth
{
    private static string $token = '';

    private static bool $isAuthenticated = false;

    public static function handle(string $token): void
    {
        self::$token = $token;
        self::authToken();
    }

    private static function authToken(): void
    {
        if (self::$token) {
            $verified = Token::decode(self::$token);

            if ($verified) {
                self::$isAuthenticated = true;
            }
        }
    }


    /**
     * Check if user is authenticated
     * @return bool
     */
    public static function check(): bool
    {
        return self::$isAuthenticated;
    }

    /**
     * Get user token
     * @return string
     */
    public static function token(): string
    {
        return self::$token;
    }
}