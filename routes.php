<?php

return [
    '/' => [
        'controller' => \App\Controller\ArticleController::class,
        'method' => 'actionIndex',
    ],
    '/article' => [
        'controller' => \App\Controller\ArticleController::class,
        'method' => 'actionArticle',
    ],
];
