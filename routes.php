<?php

use App\Controller\ArticleController;
use App\Controller\UserController;

return [
    '/' => [
        'controller' => ArticleController::class,
        'method' => 'actionIndex',
    ],
    '/article' => [
        'controller' => ArticleController::class,
        'method' => 'actionArticle',
    ],
    '/registration' => [
        'controller' => UserController::class,
        'method' => 'actionRegistration',
    ],
    '/login' => [
        'controller' => UserController::class,
        'method' => 'actionLogin',
    ],
];
