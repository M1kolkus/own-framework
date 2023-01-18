<?php

namespace App\Model;

class Article extends Model
{
    protected static string $tableName = 'articles';
    protected string $table = 'articles';
    protected ?int $id = null;
    public string $title;
    public string $content;
    protected static string $objectName = 'App\Model\Article';
    protected string $object = 'App\Model\Article';

    protected function request(): string
    {
        return "title=:title, content=:content";
    }

    protected function getParams(): array
    {
        return [
            'title' => $this->title,
            'content' => $this->content,
        ];
    }
}
