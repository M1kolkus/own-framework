<?php

namespace App;

use App\DB;
use Exception;
use PDO;

abstract class Model
{
    protected string $tableName = '';
    protected ?int $id = null;
    protected object $config;
    protected string $object = '';

    public function __construct()
    {
        $this->config = new DB();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @throws Exception
     */
    public function find(int $id): ?object
    {
        $this->id = $id;
        $stmt = $this->config->db()
            ->prepare("SELECT * FROM {$this->tableName} WHERE id = :id", [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $stmt->execute(['id' => $this->getId()]);
        $result = $stmt->fetchObject($this->object);

        return $result === false ? null : $result;
    }

    abstract protected function request();

    abstract protected function getParams();

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

    /**"SELECT * FROM {$this->tableName} WHERE id = " . $id
     * @throws Exception
     */
    protected function insert(): void
    {
        $stmt = $this->config->db()
            ->prepare(
                "INSERT INTO {$this->tableName} SET {$this->request()}",
                [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]
            );
        $stmt->execute($this->getParams());
        $id = $this->config->query("SELECT MAX(id) FROM {$this->tableName}")->fetchAll();
        $this->id = $id[0][0];
    }

    /**
     * @throws Exception
     */
    protected function update(): void
    {
        $stmt = $this->config->db()
            ->prepare("UPDATE {$this->tableName} SET {$this->request()} WHERE id = {$this->getId()}");
        $stmt->execute($this->getParams());
    }

    /**
     * @throws Exception
     */
    public function delete(): void
    {
        $this->config->query("DELETE FROM {$this->tableName} WHERE ID = {$this->getId()}");
    }
}
