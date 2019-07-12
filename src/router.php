<?php

class Router
{
    private static $routes = [];

    public static function get($path, $callback) {
        self::compileRoute($path, $callback, 'GET');
    }

    public static function post($path, $callback) {
        self::compileRoute($path, $callback, 'POST');
    }

    public static function patch($path, $callback) {
        self::compileRoute($path, $callback, 'PATCH');
    }

    public static function delete($path, $callback) {
        self::compileRoute($path, $callback, 'DELETE');
    }

    public static function view($path, $view, $data = []) {
        self::compileRoute($path, function() use ($view, $data) {
            return View::render($view, $data);
        }, 'GET');
    }

    public static function execute() {
        $uri = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];
        $routes = self::$routes;

        foreach ($routes as $route) {
            if ($route->method == $method) {
                if (preg_match($route->path, $uri, $matches)) {
                    array_shift($matches);
                    return call_user_func_array($route->callback, $matches);
                }
            }
        }
    }

    private static function compileRoute($path, $callback, $method) {
        $path = preg_replace('/\*/', '(.*)', $path);
        $path = preg_replace('/:(.+?)(?=\/|$)/', '(.+?)', $path);
        $path = preg_replace('/\//', '\/', $path);

        array_push(self::$routes, (object) [
            'method'    => $method,
            'path'      => "/^$path$/",
            'callback'  => $callback
        ]);
    }
}