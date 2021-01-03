<?php

/**
 * Lux - An ultra lightweight, fast and secure framework for PHP.
 *
 * @package  Lux
 * @author   Alphabet <alphabet@lumzapp.com>
 */

define('LUX_START'  , microtime(true));

define('DB_HOST'    , '127.0.0.1');
define('DB_NAME'    , 'database');
define('DB_USER'    , 'user');
define('DB_PASS'    , 'password');

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Handle the incoming request and send the associated response back
| to the client's browser allowing them to enjoy the enlighten
| application we have prepared for them.
|
*/

require_once './src/app.php';
