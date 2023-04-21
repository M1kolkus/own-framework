<!doctype html>
<h1><?php echo $article->title ?></h1>
<p><?php echo $article->content ?></p>
<h2>Коментарии</h2>

<?php foreach ($comments as $comment): ?>
<h3><?php echo $comment->title ?></h3>
<p><?php echo $comment->content ?></p>
<?php endforeach ?>

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
