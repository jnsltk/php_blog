<?php

namespace App\Core;

use PDO;

class App
{
    private Container $container;
    private Router $router;

    public function __construct(Container $container)
    {
        $this->container = $container;

        $this->router = $this->container->get('router');
    }

    public function run()
    {
        $this->router->dispatch();
    }
}
