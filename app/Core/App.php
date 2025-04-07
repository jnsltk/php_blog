<?php
namespace App\Core;

class App
{
    protected Router $router;

    public function __construct()
    {
        $this->router = new Router();
        $this->router->dispatch();
    }
}