<?php

namespace App\Model;

class Article extends Model
{
    protected static string $tableName = 'articles';
    protected ?int $id = null;
    public string $title;
    public string $content;

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
