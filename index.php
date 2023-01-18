<?php

use App\Router;

require_once __DIR__ . '/vendor/autoload.php';

//Запрос на самую популярную статью:
//SELECT articles.id, c.is_published, COUNT(articles.id) AS count FROM articles
//LEFT JOIN comments c on articles.id = c.article_id
//group by articles.id, c.is_published
//having c.is_published = 1
//order by count desc
//limit 3;

Router::route('/', function(){
   $a = \App\Model\Article::find(4);
    print_r($a);

});

Router::execute($_SERVER['REQUEST_URI']);
