<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Article;
use App\Model\Comment;

class ArticleController
{
    public function actionIndex(): void
    {
        $articles = Article::findAll();

        require __DIR__ . '/../Templates/index.html.php';
    }

    public function actionArticle(): void
    {
        $article = Article::find((int)$_GET['id']);

        if ($article === null) {
            http_response_code(404);
            die;
        }

        $comments = Comment::findOneBy(['article_id' => $article->getId(), 'is_published' => 1]);

        require __DIR__ . '/../Templates/article.html.php';
    }
}
