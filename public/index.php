<?php

/* -------------------------------- Constants ------------------------------- */
define('APPROOT', dirname(__DIR__) . '/app/');
define('VIEWROOT', APPROOT . 'Views/');

// Load composer autoload
require_once __DIR__ . '/../vendor/autoload.php';
// Load config file
require_once __DIR__ . '/../app/Config/config.php';

use App\Core\App;

$app = new App();