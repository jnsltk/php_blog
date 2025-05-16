<?php

namespace Tests;

use App\Core\Container;
use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected Container $container;

    protected function setUp(): void
    {
        parent::setUp();

        $this->container = new Container();

        $this->registerTestServices();
    }

    protected function registerTestServices(): void
    {
        $this->container->register('pdo', function () {
            $pdo = new \PDO('sqlite::memory:');
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            $this->setupTestDatabase($pdo);

            return $pdo;
        });

        $this->container->register('database', function ($container) {
            return new \App\Core\Database($container->get('pdo'));
        });

        $this->container->register('blogpost_model', function ($container) {
            return new \App\Models\BlogPost($container->get('database'));
        });
    }

    protected function setupTestDatabase(\PDO $pdo)
    {
        $pdo->exec('
            CREATE TABLE IF NOT EXISTS blogpost (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                title TEXT NOT NULL,
                author TEXT NOT NULL,
                content TEXT NOT NULL,
                date_created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
            );
        ');
    }
}
