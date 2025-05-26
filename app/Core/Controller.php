<?php

namespace App\Core;

class Controller
{
    protected function view(string $viewPath, array $data = [])
    {
        extract($data);

        $title = $data['title'] ?? 'János Litkei';

        // layout.php uses require to include $viewPath
        require VIEWROOT . 'layout.php';
    }
}

