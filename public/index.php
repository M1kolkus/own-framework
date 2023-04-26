<?php

require_once __DIR__ . '/../vendor/autoload.php';

$routes = require __DIR__ . '/../routes.php';

$url = $_SERVER['REQUEST_URI'];
$url = explode('?', $url)[0];

if (array_key_exists($url, $routes)) {
    $controllerName = $routes[$url]['controller'];
    $actionName = $routes[$url]['method'];
} else {
    $urlChunks = array_filter(explode('/', $url), fn($chunk) => $chunk !== '');
    $urlChunks = array_values($urlChunks);

    $controllerChunk = $urlChunks[0] ?? 'article';
    $actionChunk = $urlChunks[1] ?? 'index';

    $controllerName = '\\App\\Controller\\' . ucfirst($controllerChunk) . 'Controller';
    $actionName = 'action' . ucfirst($actionChunk);
}

try {
    $controller = new $controllerName();
    $controller->$actionName();
} catch (Throwable $exception) {
    $a = 'dasfda';
}
