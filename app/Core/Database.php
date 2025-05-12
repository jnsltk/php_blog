<?php
namespace App\Core;

use PDO;
use PDOException;
use PDOStatement;

class Database
{
    private string $host = DB_HOST;
    private string $user = DB_USER;
    private string $password = DB_PASSWORD;
    private string $dbname = DB_NAME;
    private string $dbport = DB_PORT;

    private PDO $dbh; // Database handler -- PDO
    private PDOStatement|bool $stmt; // Database statement -- PDOStatement
    private string $error; // Error message -- PDOException

    public function __construct(PDO $pdo)
    {
        $this->dbh = $pdo;
    }

    /* ---------------------------- Public functions ---------------------------- */

    public function query($sql)
    {
        $this->stmt = $this->dbh->prepare($sql);
    }

    public function execute()
    {
        return $this->stmt->execute();
    }

    public function results()
    {
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function result()
    {
        // figure out why this is necessary??
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function bind($param, $value)
    {
        $this->stmt->bindValue($param, $value);
    }
}
