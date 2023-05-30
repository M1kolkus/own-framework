<?php

declare(strict_types=1);

namespace App\Controller;

use App\Http\Request;
use App\Http\Response;
use App\Model\Article;
use App\Model\Comment;
use App\Model\User;
use App\Session\Session;
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
        $currentUserId = Session::get('currentUserId');
        $currentUser = $currentUserId === null ? $currentUserId : User::find($currentUserId);

        return new Response($this->view->render(
            'index.html.twig',
            ['articles' => $articles, 'currentUser' => $currentUser]
        ));
    }

    public function actionArticle(Request $request): Response
    {
        $article = Article::find((int)$request->getAttribute('id'));

        if ($article === null) {
            http_response_code(404);
            die;
        }

        $comments = Comment::findOneBy(['article_id' => $article->getId(), 'is_published' => 1]);
        $currentUserId = Session::get('currentUserId');
        $currentUser = $currentUserId === null ? $currentUserId : User::find($currentUserId);

        return new Response($this->view->render(
            'article.html.twig',
            ['article' => $article, 'comments' => $comments, 'currentUser' => $currentUser]
        ));
    }
}
