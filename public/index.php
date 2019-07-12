<?php

/**
 * Lux - An ultra lightweight, fast and secure framework for PHP.
 *
 * @package  Lux
 * @author   RootStar <support@48600000.xyz>
 */

define('LUX_START', microtime(true));

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

require_once __DIR__ . '/../src/app.php';