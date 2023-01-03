<?php

namespace App;

use App\Model;

class Comment extends Model
{
    protected string $tableName = 'comments';
    public int $articleId;
    public string $title;
    public string $content;
    public int $isPublished;

    protected function request(): string
    {
        return "article_id='{$this->articleId}', title='{$this->title}', content='{$this->content}', is_published='{$this->isPublished}'";
    }
}



