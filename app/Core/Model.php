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

    public function getAll()
    {
        $this->db->query("SELECT * FROM {$this->table};");
        $this->db->execute();
        return $this->db->results();
    }

    public function getByID(string $id)
    {
        $this->db->query("SELECT * FROM {$this->table} WHERE id={$id};");
        $this->db->execute();
        return $this->db->results();
    }

    public function create(array $data)
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
