<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Model\Comment;

$newComment = new Comment();
$newComment->articleId = $_REQUEST['id'];
$newComment->title = $_REQUEST['title'];
$newComment->content = $_REQUEST['content'];
$newComment->isPublished = 0;
$newComment->save();

header("Location: http://localhost:8000/article.php?id={$_REQUEST['id']}");
