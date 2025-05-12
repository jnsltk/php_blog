<?php

namespace App\Core;

use PDO;

class App
{
    protected Router $router;

    public function __construct()
    {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';port=' . DB_PORT;

        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        $pdo = new PDO($dsn, DB_USER, DB_PASSWORD, $options);
        $db = new Database($pdo);

        $this->router = new Router($db);
        $this->router->dispatch();
    }
}
