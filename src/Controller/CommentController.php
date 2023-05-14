<?php

declare(strict_types=1);

namespace App\Controller;

use App\Http\Request;
use App\Http\Response;
use App\Model\Article;
use App\Model\Comment;

class CommentController
{
    public function actionAdd(Request $request): Response
    {
        $article = Article::find((int)$request->getAttribute('id'));

        if ($article === null) {
            return new Response('', 404);
        }

        $newComment = new Comment();
        $newComment->articleId = $article->getId();
        $newComment->title = $request->getPost()['title'];
        $newComment->content = $request->getPost()['content'];
        $newComment->isPublished = 0;
        $newComment->save();

        $response = new Response('', 302);
        $response->addHeader('Location', "/article?id={$article->getId()}");

        return $response;
    }
}
