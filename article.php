<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Model\Article;
use App\Model\Comment;

$article = Article::find($_GET['id']);

if ($article === null) {
    http_response_code(404);
}

$comments = Comment::findOneBy(['article_id' => $article->getId(), 'is_published' => 1]);

require('src/Templates/article.html.php');
