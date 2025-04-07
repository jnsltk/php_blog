<?php
namespace App\Core;

class Controller
{
    protected function view(string $viewPath, array $data = [])
    {
        extract($data);

        $title = $data['title'] ?? 'János Litkei';

        // layout.php uses require_once to include $viewPath
        require_once VIEWROOT . 'layout.php';
    }
}