<?php

namespace App;

use PDO;

class Connect
{
    private $db_host = "127.0.0.1"; // сервер
    private $db_user = "root"; // имя пользователя
    private $db_pass = "root1234"; // пароль
    private $db_name = "my_db"; // название базы данных

    public static function db()
    {
        try
        {
            $db = new PDO("mysql:host=127.0.0.1;dbname=my_db", 'root', 'root1234');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch
        (PDOException $e) {
            echo "Ошибка: " . $e->getMessage();
        }

        return $db;
    }
}
