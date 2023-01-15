<?php

namespace App;

use Exception;
use PDO;
use PDOException;
use App\Config;

class DB
{
    private Config $config;

    public function __construct()
    {
        $this->config = Config::getInstance();
    }

    /**
     * @throws Exception
     */
    public function db(): PDO
    {
        try {
            $db = new PDO(
                "mysql:host={$this->config->host()};dbname={$this->config->dbName()}",
                $this->config->userName(),
                $this->config->password()
            );
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException) {
            throw new Exception('Извините. Проблемы подключения к БД.');
        }

        return $db;
    }

    /**
     * @throws Exception
     */
    public function query($sql): object
    {
        return $this->db()->query($sql);
    }
}
