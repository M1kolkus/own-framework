<?php

namespace App\routes;

use App\Controller\ArticleController;
use App\Controller\CommentController;

class Router
{
    public static function routing($url): void
    {
        $articleController = new ArticleController();
        $commentController = new CommentController();

        switch ($url) {
            case '/':
                $articleController->actionIndex();
                break;
            case '/article':
                $articleController->actionArticle();
                break;
            case '/addcomment':
                $commentController->actionAdd();
        }
    }
}
