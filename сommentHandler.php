<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Model\Article;
use App\Model\Comment;

if (Article::find($_GET['id']) === null) {
    http_response_code(404);
}

$newComment = new Comment();
$newComment->articleId = $_GET['id'];
$newComment->title = $_POST['title'];
$newComment->content = $_POST['content'];
$newComment->isPublished = 0;
$newComment->save();

header("Location: /article.php?id={$_GET['id']}");
