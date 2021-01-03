<?php

/**
 * Lux - An ultra lightweight, fast and secure framework for PHP.
 *
 * @package  Lux
 * @author   Alphabet <alphabet@lumzapp.com>
 */

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

/**
 * Return static files or trigger the app.
 */

if ($uri != '/' && file_exists('./public' . $uri))
    return false;

require_once './public/index.php';
