<?php

namespace App;

class Config
{
    private array $data;

    public function __construct()
    {
        $this->data = include __DIR__ . '/../config.php';
    }

    public function host(): string
    {
        return $this->data['host'];
    }

    public function dbName(): string
    {
        return $this->data['dbname'];
    }

    public function userName(): string
    {
        return $this->data['userName'];
    }

    public function password(): string
    {
        return $this->data['password'];
    }
}
