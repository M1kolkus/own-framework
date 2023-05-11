<?php

declare(strict_types=1);

namespace App\Http;

class Request
{
    public function __construct(
        private array $headers,
        private array $cookies,
        private array $attributes,
        private array $post,
    )
    {
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getCookies(): array
    {
        return $this->cookies;
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function getPost(): array
    {
        return $this->post;
    }
}
