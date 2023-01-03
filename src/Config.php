<?php

namespace App;

class Config
{
    public array $data;

    public function __construct()
    {
        include __DIR__ . '/../config.php';
        $this->data = $connectionData;
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
