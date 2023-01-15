<?php

namespace App;

use App\Model;
use App\DB;
use Exception;

class Article extends Model
{
    protected string $tableName = 'articles';
    protected ?int $id = null;
    public string $title;
    public string $content;
    protected string $object = 'App\Article';

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
