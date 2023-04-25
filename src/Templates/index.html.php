<!doctype html>
<?php foreach ($articles as $article): ?>
<h2><a href='/article?id=<?php echo $article->getId() ?>'><?php echo $article->title ?></a></h2>
<p><?php echo $article->content ?></p>
<?php endforeach ?>
