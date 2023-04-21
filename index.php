<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Model\Article;

$articles = Article::findAll();

require('src/Templates/index.html.php');
