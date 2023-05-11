<?php

declare(strict_types=1);

namespace App\Controller;

use App\Http\Request;
use App\Model\Article;
use App\Model\Comment;

class CommentController
{
    public function actionAdd(Request $request): void
    {
        $article = Article::find((int)$request->getAttributes()['id']);
        if ($article === null) {
            http_response_code(404);
            die;
        }

        $newComment = new Comment();
        $newComment->articleId = $article->getId();
        $newComment->title = $request->getPost()['title'];
        $newComment->content = $request->getPost()['content'];
        $newComment->isPublished = 0;
        $newComment->save();

        header("Location: /article?id={$article->getId()}");
    }
}
