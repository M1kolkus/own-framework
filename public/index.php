<?php

use App\routes\Router;

require_once __DIR__ . '/../vendor/autoload.php';

$url = $_SERVER['REQUEST_URI'];
$url = explode('?', $url)[0];

try {
    Router::routing($url);
} catch (Throwable $exception) {
    $a = 'dasfda';
}
