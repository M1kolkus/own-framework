<?php

use App\Http\Request;
use App\Http\Response;

require_once __DIR__ . '/../vendor/autoload.php';

session_start();

$routes = require __DIR__ . '/../routes.php';

$url = $_SERVER['REQUEST_URI'];
$url = explode('?', $url)[0];

$headers = [];
foreach ($_SERVER as $header => $value) {
    if (str_starts_with($header, 'HTTP_')) {
        $headerArray = array_slice(explode('_', $header), 1);
        $header = strtolower(implode('-', $headerArray));
        $headers[$header] = $value;
    }
}

unset($headers['cookie']);

$request = new Request($headers, $_COOKIE, $_GET, $_POST);

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
    /** @var Response $response */
    $response = $controller->$actionName($request);
    http_response_code($response->getStatusCode());
    $_SESSION['user'] = $response->getCookie()['user'];

    foreach ($response->getHeaders() as $header => $value) {
        header("{$header}: {$value}");
    }

    echo $response->getContent();
} catch (Throwable $exception) {
    echo $exception->getMessage();
}
