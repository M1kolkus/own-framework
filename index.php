<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Model\Article;

$articles = Article::findAll();

foreach ($articles as $article) {
    echo "<h2><a href='/article.php?id={$article->getId()}'>$article->title</a></h2>";
    echo "<p>$article->content</p>";
}
