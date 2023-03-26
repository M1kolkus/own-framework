<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Model\Article;
use App\Model\Comment;

$article = Article::find($_GET['id']);
$comments = Comment::findOneBy(['article_id' => $article->getId(), 'is_published' => 1]);

echo "<h1>$article->title</h1>";
echo "<p>$article->content</p>";
echo "<h2>Коментарии</h2>";

foreach ($comments as $comment) {
    echo "<h3>$comment->title</h3>";
    echo "<p>$comment->content</p>";
}
?>

<!doctype html>
<form action='/сommentHandler.php?id=<?php echo $_GET['id'] ?>' method="POST">
    <label for="comment">Введите коментарий</label>
    <label>
        <input name="title" placeholder="Название коментария">
    </label>
    <label>
        <input name="content" placeholder="Текст коментария">
    </label>
    <input type=submit value="Добавить коментарий">
</form>
