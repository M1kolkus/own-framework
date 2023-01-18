<?php

namespace App;

class Router
{
    private static array $routes = [];

    private function __construct() {}
    private function __clone() {}

    public static function route($pattern, $callback): void
    {
        $pattern = '/^' . str_replace('/', '\/', $pattern) . '$/';
        self::$routes[$pattern] = $callback;
    }

    public static function execute($url): mixed
    {
        foreach (self::$routes as $pattern => $callback)
        {
            if (preg_match($pattern, $url, $params))
            {
                array_shift($params);
                return call_user_func_array($callback, array_values($params));
            }

            http_response_code(404);
        }
    }
}
