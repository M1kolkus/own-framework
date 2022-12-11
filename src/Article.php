<?php

require_once '../vendor/autoload.php';

use App\Connect;

class Article
{
    public int $id = 0;
    public string $title;
    public string $content;

    public static function find(int $id): object|false
    {
       $find = Connect::db()->query("SELECT * FROM articles WHERE id = " . $id);
       return $find->fetchObject();
    }

    public function save()
    {
        if ($this->id > 0) {
            Connect::db()->query("UPDATE articles SET title='{$this->title}', content='{$this->content}' WHERE id = {$this->id}");
        } else {
            Connect::db()->query("INSERT INTO articles SET title='{$this->title}', content='{$this->content}'");
            $id = (Connect::db()->query("SELECT MAX(id) FROM articles")->fetchAll());
            $this->id = $id[0][0];
        }
    }

    public function delete()
    {
        Connect::db()->query("DELETE FROM articles WHERE ID = " . $this->id);
    }
}


