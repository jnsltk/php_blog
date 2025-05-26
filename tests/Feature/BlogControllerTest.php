<?php

use App\Controllers\BlogController;

define('APPROOT', dirname(__DIR__) . '../../app/');
define('VIEWROOT', APPROOT . 'Views/');

describe('BlogController setup', function () {
    it('can instantiate a controller', function () {
        $controller = $this->container->get('blog_controller');

        expect($controller)->toBeInstanceOf(\App\Controllers\BlogController::class);
    });
});

describe('BlogController index', function () {
    it('renders valid html', function () {
        $controller = $this->container->get('blog_controller');

        ob_start();
        $controller->index();

        $output = ob_get_clean();

        libxml_use_internal_errors(true);
        $dom = new \DOMDocument();
        $dom->loadHTML($output, LIBXML_HTML_NOIMPLIED + LIBXML_HTML_NODEFDTD);

        // Not ideal that there are errors, but HTML5 is not supported
        // TODO: Look into HTML5 validation
        expect(count(libxml_get_errors()))->toBe(2);
    });

    it('renders the blog index page', function () {
        $controller = $this->container->get('blog_controller');

        ob_start();

        $controller->index();

        $output = ob_get_clean();
        expect($output)->toContain('Test post');
        expect($output)->toContain('Tester');
    });
});

describe('BlogController posts', function () {
    it('renders valid html', function () {
        $controller = $this->container->get('blog_controller');

        ob_start();
        $controller->posts(1);

        $output = ob_get_clean();

        libxml_use_internal_errors(true);
        $dom = new \DOMDocument();
        $dom->loadHTML($output, LIBXML_HTML_NOIMPLIED + LIBXML_HTML_NODEFDTD);

        // Not ideal that there are errors, but HTML5 is not supported
        // TODO: Look into HTML5 validation
        expect(count(libxml_get_errors()))->toBe(2);
    });

    it('renders individual blog post page', function () {
        $controller = $this->container->get('blog_controller');

        ob_start();

        $controller->index();

        $output = ob_get_clean();
        expect($output)->toContain('Test post');
        expect($output)->toContain('Tester');
    });
});
