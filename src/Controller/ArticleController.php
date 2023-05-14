<?php

declare(strict_types=1);

namespace App\Controller;

use App\Http\Request;
use App\Http\Response;
use App\Model\Article;
use App\Model\Comment;
use App\View\View;

class ArticleController
{
    private View $view;

    public function __construct()
    {
        $this->view = View::getInstance();
    }

    public function actionIndex(Request $request): Response
    {
        $articles = Article::findAll();

        return new Response($this->view->render('index.html.twig', ['articles' => $articles]));
    }

    public function actionArticle(Request $request): Response
    {
        $article = Article::find((int)$request->getAttribute('id'));

        if ($article === null) {
            http_response_code(404);
            die;
        }

        $comments = Comment::findOneBy(['article_id' => $article->getId(), 'is_published' => 1]);

        return new Response($this->view->render('article.html.twig', ['article' => $article, 'comments' => $comments]));
    }
}
