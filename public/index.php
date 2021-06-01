<?php
require_once '../vendor/autoload.php';

use app\controller\SiteController;
use app\core\AuthController;
use app\core\Application;
use app\controller\FeedbackController;

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD']
    ]
];

$app = new Application(dirname(__DIR__), $config);

$app->router->get('/', [SiteController::class, 'index']);
$app->router->post('/', [SiteController::class, 'addAnAppointment']);

$app->run();