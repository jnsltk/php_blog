<?php

use App\Core\Database;


describe('setup', function () {
    it('can connect to the database', function () {
        $pdo = new \PDO('sqlite::memory:');
        $db = new Database($pdo);

        expect($db)->toBeInstanceOf(Database::class);
    });
});

describe('query', function () {
    afterEach(function () {
        $db = $this->container->get('database');
        $db->query('DELETE FROM blogpost;');
        $db->execute();
    });

    it('can prepare a query', function () {
        $db = $this->container->get('database');

        $result = $db->query('SELECT * FROM blogpost;');
        expect($result)->toBe(true);
    });

    it('returns false on a bad query', function () {
        $db = $this->container->get('database');

        $result = $db->query('SELECT * FROM nonexistent_table;');
        expect($result)->toBe(false);
    });

    it('can execute a query', function () {
        $db = $this->container->get('database');
        $db->query("INSERT INTO blogpost (title, author, content)
            VALUES (
                'Test',
                'Tester',
                'Test content'
            );
        ");

        $executeStatus = $db->execute();
        expect($executeStatus)->toBeTrue();

        $queryStatus = $db->query('SELECT * FROM blogpost;');
        expect($queryStatus)->toBeTrue();

        $executeStatus = $db->execute();
        expect($executeStatus)->toBeTrue();

        $results = $db->results();

        expect($results)->toBeArray();
        expect(count($results))->toBe(1);
        expect($results[0]['title'])->toBe('Test');
    });

    it('can bind values', function () {
        $db = $this->container->get('database');
        $db->query("INSERT INTO blogpost (title, author, content)
            VALUES (
                :title,
                :author,
                :content
            );
        ");

        $values = ['Title', 'Author', 'Content'];
        foreach ($values as $value) {
            $status = $db->bind(':' . strtolower($value), $value);
            expect($status)->toBeTrue();
        }
        
        $executeStatus = $db->execute();
        expect($executeStatus)->toBeTrue();

        $queryStatus = $db->query('SELECT * FROM blogpost;');
        expect($queryStatus)->toBeTrue();

        $executeStatus = $db->execute();
        expect($executeStatus)->toBeTrue();

        $results = $db->results();

        expect($results)->toBeArray();
        expect(count($results))->toBe(1);
        expect($results[0]['title'])->toBe('Title');
    });

    it('can return a single result', function () {
        $db = $this->container->get('database');
        $db->query("INSERT INTO blogpost (title, author, content)
            VALUES (
                'Test1',
                'Tester',
                'Test content'
            );
        ");

        $executeStatus = $db->execute();
        expect($executeStatus)->toBeTrue();

        $db->query("INSERT INTO blogpost (title, author, content)
            VALUES (
                'Test2',
                'Tester',
                'Test content'
            );
        ");

        $executeStatus = $db->execute();
        expect($executeStatus)->toBeTrue();

        $queryStatus = $db->query('SELECT * FROM blogpost;');
        expect($queryStatus)->toBeTrue();

        $executeStatus = $db->execute();
        expect($executeStatus)->toBeTrue();

        $result = $db->result();

        expect($result)->toBeArray();
        expect(count($result))->toBe(5);
        expect($result['title'])->toBe('Test1');
    });

    it('can return multiple results', function () {
        $db = $this->container->get('database');
        $db = $this->container->get('database');
        $db->query("INSERT INTO blogpost (title, author, content)
            VALUES (
                'Test1',
                'Tester',
                'Test content'
            );
        ");

        $executeStatus = $db->execute();
        expect($executeStatus)->toBeTrue();

        $db->query("INSERT INTO blogpost (title, author, content)
            VALUES (
                'Test2',
                'Tester',
                'Test content'
            );
        ");

        $executeStatus = $db->execute();
        expect($executeStatus)->toBeTrue();

        $queryStatus = $db->query('SELECT * FROM blogpost;');
        expect($queryStatus)->toBeTrue();

        $executeStatus = $db->execute();
        expect($executeStatus)->toBeTrue();

        $results = $db->results();

        expect($results)->toBeArray();
        expect(count($results))->toBe(2);
    });
});
