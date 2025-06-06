<?php

namespace App\Core;

class Router
{
    /* -------------------------------- Defaults -------------------------------- */
    protected string $controller = 'App\\Controllers\\BlogController';
    protected string $method = 'index';
    protected array $params = [];
    protected Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    /* --------------------------------- Methods -------------------------------- */
    public function dispatch()
    {
        $url = $this->getUrl();

        // Resolve controller
        if (!empty($url[0])) {
            $controllerCandidate = ucfirst($url[0]) . 'Controller';
            $controllerClass = 'App\\Controllers\\' . $controllerCandidate;

            if (class_exists($controllerClass)) {
                $this->controller = $controllerClass;
                unset($url[0]);
            }
        }

        $controllerClass = $this->controller;
        $controllerObject = new $controllerClass($this->db);

        // Resolve method
        if (isset($url[1])) {
            if (method_exists($controllerObject, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // Resolve parameters
        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$controllerObject, $this->method], $this->params);
    }

    protected function getUrl(): array
    {
        if (!isset($_GET['url'])) return [];
        return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
    }
}
