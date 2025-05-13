<?php

use App\Core\Database;

it('can connect to the database', function () {
    $pdo = new \PDO('sqlite::memory:');
    $db = new Database($pdo);

    expect($db)->toBeInstanceOf(Database::class);
});

it('can execute a query', function () {
    $pdo = new \PDO('sqlite::memory:');
    $pdo->exec('CREATE TABLE test (id INTEGER PRIMARY KEY, name TEXT)');
    $pdo->exec("INSERT INTO test (name) VALUES ('Test')");
    
    $db = new Database($pdo);
    $db->query('SELECT * FROM test');
    $db->execute();
    $result = $db->results();
    
    expect($result)->toBeArray();
    expect($result[0]['name'])->toBe('Test');
} );