<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Article;
use App\Model\Comment;

class CommentController
{
    public function actionAdd(): void
    {
        $article = Article::find((int)$_GET['id']);
        if ($article === null) {
            http_response_code(404);
            die;
        }

        $newComment = new Comment();
        $newComment->articleId = $article->getId();
        $newComment->title = $_POST['title'];
        $newComment->content = $_POST['content'];
        $newComment->isPublished = 0;
        $newComment->save();

        header("Location: /article?id={$article->getId()}");
    }
}
