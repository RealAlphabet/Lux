<?php

class Router
{
    private static $routes = [];

    /**
     * Route methods.
    */
    public static function get($path, $callback) {
        self::compileRoute('GET', $path, $callback);
    }

    public static function post($path, $callback) {
        self::compileRoute('POST', $path, $callback);
    }

    public static function patch($path, $callback) {
        self::compileRoute('PATCH', $path, $callback);
    }

    public static function delete($path, $callback) {
        self::compileRoute('DELETE', $path, $callback);
    }

    public static function view($path, $view, $data = []) {
        self::compileRoute('GET', $path, fn() => View::render($view, $data));
    }

    /**
    * Execute the router.
    */
    public static function execute() {
        $uri    = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];
        $routes = self::$routes;

        foreach ($routes as $route)
            if ($route->method == $method)
                if (preg_match_all($route->path, $uri, $matches, PREG_SET_ORDER))
                    return call_user_func_array($route->callback, $matches);
    }

    /**
     * Compile a route.
     */
    private static function compileRoute($method, $path, $callback) {
        $path = preg_replace('/\*/', '(.*)', $path);
        $path = preg_replace('/:(.+?)(?=\/|$)/', '(.+?)', $path);
        $path = preg_replace('/\//', '\/', $path);
        $path = "/^$path$/";

        array_push(self::$routes, (object) [
            'method'    => $method,
            'path'      => $path,
            'callback'  => $callback
        ]);
    }
}
