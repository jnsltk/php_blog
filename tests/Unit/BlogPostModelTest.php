<?php

use App\Models\BlogPost;

describe('BlogPost model', function () {
    afterEach(function () {
        $db = $this->container->get('database');
        $db->query('DELETE FROM blogpost;');
        $db->execute();
    });

    it('can initialize a model', function () {
        $model = $this->container->get('blogpost_model');

        expect($model)->toBeInstanceOf(BlogPost::class);
    });

    it('can create a new blogpost', function () {
        $model = $this->container->get('blogpost_model');
        expect($model->getTable())->toBe('blogpost');

        $data = ['title' => 'My amazing post', 'author' => 'Me', 'content' => 'The contents of my amazing post'];

        $resultStatus = $model->create($data);

        expect($resultStatus)->toBeTrue();
    });
    
    it('can retrieve all blogposts', function () {
        $model = $this->container->get('blogpost_model');
        $data1 = ['title' => 'My amazing post #1', 'author' => 'Me', 'content' => 'The contents of my amazing post'];
        $data2 = ['title' => 'My amazing post #2', 'author' => 'Me', 'content' => 'The contents of my amazing post'];

        $resultStatus1 = $model->create($data1);
        $resultStatus2 = $model->create($data2);

        expect($resultStatus1)->toBeTrue();
        expect($resultStatus2)->toBeTrue();

        $results = $model->getAll();
        expect($results)->not->toBeFalse();
        expect(count($results))->toBe(2);
        expect($results[0]['title'])->toBe('My amazing post #1');
        expect($results[1]['title'])->toBe('My amazing post #2');
    });

    it('can retrieve a blogpost by id', function () {
        $model = $this->container->get('blogpost_model');
        $data1 = ['title' => 'My amazing post #1', 'author' => 'Me', 'content' => 'The contents of my amazing post'];
        $data2 = ['title' => 'My amazing post #2', 'author' => 'Me', 'content' => 'The contents of my amazing post'];

        $resultStatus1 = $model->create($data1);
        $resultStatus2 = $model->create($data2);

        expect($resultStatus1)->toBeTrue();
        expect($resultStatus2)->toBeTrue();
        
        $result = $model->getByID('1');
        expect($result)->not->toBeFalse();
        expect(count($result))->toBe(5);
        expect($result['title'])->toBe('My amazing post #1');
    });
});
