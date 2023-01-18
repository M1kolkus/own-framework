<?php

namespace App;

class Config
{
    private array $data;
    private static ?Config $instance = null;

    private function __construct()
    {
        $this->data = include __DIR__ . '/../config.php';
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
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
