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

    public function getAttribute(string $name, mixed $default = null): mixed
    {
        return $this->attributes[$name] ?? $default;
    }

    public function getPost(): array
    {
        return $this->post;
    }

    public function setCookies(array $cookies): void
    {
        $this->cookies = array_merge($this->cookies, $cookies);
    }
}
