<?php

declare(strict_types=1);

namespace App\Http;

class Response
{
    private string $content;
    private array $headers = [];
    private int $statusCode;
    private array $cookie = [];


    public function __construct(string $content, int $statusCode = 200)
    {
        $this->content = $content;
        $this->statusCode = $statusCode;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function addHeader(string $name, string $value): self
    {
        $this->headers[$name] = $value;

        return $this;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function setStatusCode(int $statusCode): self
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    public function getCookie(): array
    {
        return $this->cookie;
    }

    public function setCookie(array $cookie): void
    {
        $this->cookie = $cookie;
    }
}
