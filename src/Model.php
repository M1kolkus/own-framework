<?php

namespace App;

use App\DB;
use Exception;

abstract class Model
{
    protected string $tableName = '';
    protected ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @throws Exception
     */
    public static function find(int $id): ?object
    {
        $query = DB::db()->query("SELECT * FROM {$this->tableName} WHERE id = " . $id);
        $result = $query->fetchObject();

        return $result === false ? null : $result;
    }

    abstract protected function request();

    /**
     * @throws Exception
     */
    public function save(): void
    {
        if ($this->id !== null) {
            $this->update();
        } else {
            $this->insert();
        }
    }

    /**
     * @throws Exception
     */
    protected function insert(): void
    {
        DB::db()->query("INSERT INTO {$this->tableName} SET {$this->request()}");
        $id = (DB::db()->query("SELECT MAX(id) FROM {$this->tableName}")->fetchAll());
        $this->id = $id[0][0];
    }

    /**
     * @throws Exception
     */
    protected function update(): void
    {
        DB::db()->query("UPDATE {$this->tableName} SET {$this->request()} WHERE id = {$this->id}");
    }

    /**
     * @throws Exception
     */
    public function delete(): void
    {
        DB::db()->query("DELETE FROM {$this->tableName} WHERE ID = " . $this->id);
    }
}