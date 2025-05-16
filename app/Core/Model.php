<?php

namespace App\Core;

use App\Core\Database;

abstract class Model
{
    protected Database $db;
    protected string $table;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    /**
     * Get all items from database
     *
     * @return array|false Results or false on failure
     */
    public function getAll(): array|false
    {
        $this->db->query("SELECT * FROM {$this->table};");
        $this->db->execute();
        return $this->db->results();
    }

    /**
     * Get item from database by id
     *
     * @param string $id Item id
     * @return array|false Results or false on failure
     */
    public function getByID(string $id): array|false
    {
        $this->db->query("SELECT * FROM {$this->table} WHERE id={$id};");
        $this->db->execute();
        return $this->db->result();
    }

    /**
     * Add new item to database
     *
     * @param array $data Array of fields for the item to be created
     * @return bool Result status
     */
    public function create(array $data): bool
    {
        $fields = array_keys($data);
        $placeholders = array_map(fn($field) => ':' . $field, $fields);

        $this->db->query("INSERT INTO {$this->table} (" . implode(",", $fields) . ") VALUES (" . implode(",", $placeholders) . ");");

        foreach ($data as $field => $value) {
            $this->db->bind(':' . $field, $value);
        }

        return $this->db->execute();
    }

    // TODO: implement update, delete
}
