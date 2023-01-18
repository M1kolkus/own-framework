<?php

namespace App\Model;

use App\DB\DB;

abstract class Model
{
    protected static string $tableName = '';
    protected string $table = '';
    protected ?int $id = null;
    protected object $db;
    protected static string $objectName = '';
    protected string $object = '';

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
        $objectName = static::$objectName;
        $params = ['params' => [':id' => $id], 'object' => $objectName];
        $db = DB::getInstance();
        $result = $db->query("SELECT * FROM {$tableName} WHERE id = :id", $params);

        if (empty($result)) {
            return null;
        }

        return $result[0];
    }


    public static function findAll(): array
    {
        $tableName = static::$tableName;
        $objectName = static::$objectName;
        $params = ['params' => [], 'object' => $objectName];
        $db = DB::getInstance();

        return $db->query("SELECT * FROM {$tableName}", $params);
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
        $sql = "INSERT INTO {$this->table} SET {$this->request()}";
        $params = ['params' => $this->getParams(), 'object' => $this->object];
        $this->db->query($sql, $params);

        $paramsObject = ['params' => [], 'object' => $this->object];
        $arrayObject = $this->db->query("SELECT MAX(id) FROM {$this->table}", $paramsObject);
        $object = $arrayObject[0];
        $this->id = $object->getId();
    }

    protected function update(): void
    {
        $sql = "UPDATE {$this->table} SET {$this->request()} WHERE id = {$this->getId()}";
        $params = ['params' => $this->getParams(), 'object' => $this->object];
        $this->db->query($sql, $params);
    }

    public function delete(): void
    {
        $this->db->query("DELETE FROM {$this->table} WHERE ID = {$this->getId()}");
    }
}
