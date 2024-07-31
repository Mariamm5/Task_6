<?php

class Router
{
    private $routes = [];

    public function add($rout, $fn)
    {
        $this->routes[$rout] = $fn;
    }

    public function dispatch($url)
    {
        if (array_key_exists($url, $this->routes)) {
            call_user_func($this->routes[$url]);
        } else {
            echo "Error 404.Page not found!";
        }
    }
}