<?php

declare(strict_types=1);

/* -------------------------------- Constants ------------------------------- */
define('APPROOT', dirname(__DIR__) . '/app/');
define('VIEWROOT', APPROOT . 'Views/');

/* --------------------------- Autoload and config -------------------------- */
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/Config/config.php';

/* ----------------------- Load environment variables ----------------------- */
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->safeLoad();

/* -------------------------- Pretty errors in dev -------------------------- */
$env = $_ENV['APP_ENV'] ?: 'production';

if ($env == 'development' && class_exists(\Whoops\Run::class)) {
    $whoops = new \Whoops\Run;
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();
} else {
    ini_set('display_errors', 0);
    error_reporting(E_ALL);
    ini_set('log_errors', 1);
    ini_set('error_log', __DIR__ . '/../storage/logs/php-error.log');
}

/* ------------------------------ Bootstrap app ----------------------------- */

use App\Core\App;
use App\Core\Container;
use App\Core\Database;
use App\Core\Router;

$container = new Container();

// Register services
$container->register('pdo', function ($container) {
    return new PDO(
        'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';port=' . DB_PORT,
        DB_USER,
        DB_PASSWORD,
        [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    );
});

$container->register('database', function($container) {
    return new Database($container->get('pdo'));
});

$container->register('router', function($container) {
    return new Router($container->get('database'));
});

$container->register('app', function($container) {
    return new App($container);
});

$app = $container->get('app');
$app->run();
