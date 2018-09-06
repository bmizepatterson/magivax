<?php

class Router
{
    protected $routes = [];

    public static function load($file)
    {
        $router = new self;
        require $file;
        return $router;
    }

    public function define($uri, $controller)
    {
        $this->routes[$uri] = $controller;
    }

    public function direct($uri)
    {
        if (array_key_exists($uri, $this->routes)) {
            return $this->routes[$uri];
        }
        http_response_code(404);
        include '404.php';
        die();
    }
}
