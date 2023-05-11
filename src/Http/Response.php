<?php

declare(strict_types=1);

namespace App\Http;

class Response
{
    private string $content;

    public function __construct($content)
    {
        $this->content = $content;
    }

    public function getContent(): string
    {
        return $this->content;
    }
}
