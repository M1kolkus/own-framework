<?php

namespace App;

use Exception;
use PDO;
use PDOException;
use App\Config;

class DB
{
    /**
     * @throws Exception
     */
    public static function db(): PDO
    {
        $data = new Config();
        try {
            $db = new PDO("mysql:host={$data->host()};dbname={$data->dbName()}", $data->userName(), $data->password());
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new Exception('Извините. Проблемы подключения к БД.');
        }

        return $db;
    }
}
