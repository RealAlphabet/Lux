<?php

session_name('LUXID');
session_start();

// Load classes.
require_once 'session.php';
require_once 'database.php';
require_once 'router.php';
require_once 'response.php';
require_once 'view.php';

// Compile routes.
require_once 'app/routes.php';

// Execute router.
$response = Router::execute();

if ($response) {
    if ($response instanceof Response) {
        $response->send();

    } else {
        print_r($response);
    }

} else {
    echo "404 not found.";
}
