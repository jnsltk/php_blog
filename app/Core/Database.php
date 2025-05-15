<?php

namespace App\Core;

use PDO;
use PDOException;
use PDOStatement;

class Database
{
    private PDO $dbh; // Database handler -- PDO
    private ?PDOStatement $stmt; // Database statement -- PDOStatement

    public function __construct(PDO $pdo)
    {
        $this->dbh = $pdo;
    }

    /* ---------------------------- Public functions ---------------------------- */

    /**
     * Prepare an SQL statement
     * 
     * @param string $sql SQL query to prepare
     * @return bool Success status
     */
    public function query($sql): bool
    {
        try {
            $this->stmt = $this->dbh->prepare($sql);
            return true;
        } catch (PDOException $e) {
            // Add logging later
            return false;
        }
    }

    /**
     * Execute the prepared statement
     * 
     * @return bool Success status
     */
    public function execute(): bool
    {
        if (!$this->stmt) {
            return false;
        }

        try {
            return $this->stmt->execute();
            return true;
        } catch (PDOException $e) {
            // Add logging later
            return false;
        }
    }

    /**
     * Fetch all rows from the executed statement
     * 
     * @return array|false All rows or false on failure
     */
    public function results(): array|false
    {
        if (!$this->stmt) {
            return false;
        }

        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Fetch a single row from the executed statement
     * 
     * @return array|false Single row or false on failure
     */
    public function result(): array|false
    {
        if (!$this->stmt) {
            return false;
        }

        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }
    /**
     * Bind a value to a parameter in the statement
     * 
     * @param mixed $param Parameter identifier
     * @param mixed $value Value to bind
     * @param int $type PDO parameter type
     * @return bool Success status
     */
    public function bind($param, $value, $type = PDO::PARAM_STR ): bool
    {
        return $this->stmt->bindValue($param, $value, $type);
    }
}
