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
        $this->pdo =  new PDO(
            "mysql:host={$config->host()};dbname={$config->dbName()}",
            $config->userName(),
            $config->password()
        );
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

     public function query($sql, $params = []): array
    {
        if ($params === []) {
            $this->pdo->query($sql);
            exit();
        }

        $sth = $this->pdo->prepare($sql);
        $sth->execute($params['params']);

        return $sth->fetchAll(PDO::FETCH_CLASS, $params['object']);
    }
}
