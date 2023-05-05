<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Article;
use App\Model\Comment;
use Twig\Environment;

class ArticleController
{
    private Environment $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function actionIndex(): string
    {
        $articles = Article::findAll();

        return $this->twig->render('index.html.twig', ['articles' => $articles]);
    }

    public function actionArticle(): string
    {
        $article = Article::find((int)$_GET['id']);

        if ($article === null) {
            http_response_code(404);
            die;
        }

        $comments = Comment::findOneBy(['article_id' => $article->getId(), 'is_published' => 1]);

        return $this->twig->render('article.html.twig', ['article' => $article, 'comments' => $comments]);
    }
}
