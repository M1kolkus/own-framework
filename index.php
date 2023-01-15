<?php

use App\Comment;
use App\Controller\ArticleController;
use App\Router;

require_once __DIR__ . '/vendor/autoload.php';

//Запрос на самую популярную статью:
//SELECT articles.id, c.is_published, COUNT(articles.id) AS count FROM articles
//LEFT JOIN comments c on articles.id = c.article_id
//group by articles.id, c.is_published
//having c.is_published = 1
//order by count desc
//limit 3;

//var_dump($_SERVER['REQUEST_URI']);
//Router::route('/', function(){
//    require_once(__DIR__ . '/src/Web/Start.html');
//    $controller = new ArticleController();
//    $arrayArticles = $controller->Show();
//    foreach($arrayArticles as $row) {
//        print $row['title'] . "\t";
//        print $row['content'] . "\t";
//    }
//});
//
//Router::route('/article', function(){
//    print 'fbsb';
//});
//
//// запускаем маршрутизатор, передавая ему запрошенный адрес
//Router::execute($_SERVER['REQUEST_URI']);

//$controller = new ArticleController();
//$arrayArticles = $controller->Show();
var_dump('fdbsbsb');
//foreach($arrayArticles as $row) {
  //  print $row['title'] . "\t";
    //print $row['content'] . "\t";
//}