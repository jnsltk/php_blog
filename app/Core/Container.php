<?php

namespace App\Core;

use Exception;

class Container
{
    private array $services = [];
    private array $instances = [];

    public function register($name, $resolver)
    {
        $this->services[$name] = $resolver;
    }

    public function get($name)
    {
        if (!isset($this->instances[$name])) {
            if (!isset($this->services[$name])) {
                throw new Exception("Service '{$name}' not found in container");
            }

            $resolver = $this->services[$name];
            $this->instances[$name] = $resolver($this);
        }

        return $this->instances[$name];
    }

    public function has($name) 
    {
        return isset($this->services[$name]);
    }
}
