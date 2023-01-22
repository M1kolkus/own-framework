<?php

namespace App\DB;

use App\Config;
use PDO;

class DB
{
    private static ?DB $instance = null;
    private PDO $pdo;

    private function __construct()
    {
        $config = Config::getInstance();
        $this->pdo = new PDO(
            "mysql:host={$config->host()};dbname={$config->dbName()}",
            $config->userName(),
            $config->password(),
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function query(string $sql, array $params = [], string $className = null): array
    {
        $sth = $this->pdo->prepare($sql);
        $sth->execute($params);

        if (null !== $className) {
            return $sth->fetchAll(PDO::FETCH_CLASS, $className);
        }

        return $sth->fetchAll(PDO::FETCH_CLASS);
    }

    public function exec(string $sql, array $params = []): void
    {
        $sth = $this->pdo->prepare($sql);
        $sth->execute($params);
    }

    public function getLastInsertId(): ?int
    {
        $id = $this->pdo->lastInsertId();

        if ($id === false) {
            return null;
        }

        return (int) $id;
    }
}
