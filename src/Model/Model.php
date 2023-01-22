<?php

namespace App\Model;

use App\DB\DB;

abstract class Model
{
    protected static string $tableName = '';
    protected ?int $id = null;
    protected object $db;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public static function find(int $id): ?object
    {
        $tableName = static::$tableName;
        $result = DB::getInstance()->query("SELECT * FROM {$tableName} WHERE id = :id", [':id' => $id], static::class);

        if (empty($result)) {
            return null;
        }

        return $result[0];
    }

    public static function findAll(): array
    {
        $tableName = static::$tableName;

        return DB::getInstance()->query("SELECT * FROM {$tableName}", [], static::class);
    }

    abstract protected function request();

    abstract protected function getParams();

    public function save(): void
    {
        if ($this->id !== null) {
            $this->update();
        } else {
            $this->insert();
        }
    }

    protected function insert(): void
    {
        $tableName = static::$tableName;
        $sql = "INSERT INTO {$tableName} SET {$this->request()}";
        $this->db->exec($sql, $this->getParams());
        $this->id = $this->db->getLastInsertId();
    }

    protected function update(): void
    {
        $tableName = static::$tableName;
        $sql = "UPDATE {$tableName} SET {$this->request()} WHERE id = :id";
        $this->db->exec($sql, array_merge($this->getParams(), [':id' => $this->id]));
    }

    public function delete(): void
    {
        $tableName = static::$tableName;
        $this->db->exec("DELETE FROM {$tableName} WHERE id = :id", [':id' => $this->id]);
    }
}
