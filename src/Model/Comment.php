<?php

namespace App\Model;

class Comment extends Model
{
    protected static string $tableName = 'comments';
    protected string $table = 'comments';
    public int $articleId;
    public string $title;
    public string $content;
    public int $isPublished;
    protected static string $objectName = 'App\Model\Comment';
    protected string $object = 'App\Model\Comment';

    protected function request(): string
    {
        return "article_id=:articleId, title=:title, content=:content, is_published=:isPublished";
    }

    protected function getParams(): array
    {
        return [
            'articleId' => $this->articleId,
            'title' => $this->title,
            'content' => $this->content,
            'isPublished' => $this->isPublished
        ];
    }
}
